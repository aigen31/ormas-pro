# Локальная разработка ormas.pro

Репозиторий содержит только WordPress-тему. Для локального запуска в `docker-compose.yml`
поднимается полноценный WordPress, база MariaDB, Mailpit для писем и одноразовый
контейнер, который сам устанавливает WordPress, активирует тему и создаёт тестовые страницы.

## Быстрый старт

Требуется Docker с плагином Compose.

```bash
cp .env.example .env   # уже создан локально; можно изменить порты и пароли
make up
```

После запуска:

- Публичный адрес: <https://ormas.dev.inteli-dev.ru> (Traefik + Let's Encrypt,
  A-запись домена смотрит на сервер)
- Локально на сервере: <http://localhost:8083> (редиректит на публичный адрес)
- Сайт: <http://localhost:8083>
- Админка: <http://localhost:8083/wp-admin/>
  - логин: `admin`
  - пароль: `admin`
- Письма (Mailpit): <http://localhost:8026>

Порт меняется через `WP_PORT` и `WP_URL` в `.env`. Сайт слушает только `127.0.0.1`,
наружу не публикуется. База данных доступна только внутри Docker-сети.
Если ваш UID/GID не `1000`, поменяйте `LOCAL_UID`/`LOCAL_GID` в `.env`, чтобы
Composer создавал `vendor/` с правильным владельцем.

## Как это работает

- `composer` — ставит зависимости темы (`htmlburger/carbon-fields`) в `vendor/`.
- `wordpress` — официальный образ WordPress + Apache; код темы примонтирован из репозитория,
  поэтому изменения PHP/CSS/JS видны сразу.
- `wp-init` — ждёт готовности базы и `wp-config.php`, затем выполняет `wp core install`,
  активирует тему и плагины `cyr2lat` и `svg-support`, создаёт страницы услуг и служебные
  страницы. Скрипт идемпотентен.
- `db` — MariaDB с именованным томом `ormas-pro_db_data`.
- `mailpit` — перехватывает письма через SMTP; WordPress настроен на `mailpit:1025`.

## Команды

```bash
make ps                 # состояние контейнеров
make logs               # логи WordPress и инициализации
make test               # smoke-тесты сайта, темы, страниц и писем
make seed               # заполнить все Carbon Fields тестовыми данными и изображениями
make down               # остановить
make reset              # остановить и удалить базу/файлы WordPress (тома)
make wp CMD="theme list"
make wp CMD="plugin list"
```

Полный сброс и повторная установка:

```bash
make reset
make up
```

## Разработка темы

Точка входа темы — `functions.php`. Стили и скрипты лежат в `assets/`, Carbon Fields —
в `inc/custom-fields/`, шаблоны — в `templates/` и `template-parts/`.

Composer-зависимости переустанавливаются автоматически при изменении `composer.lock`.
Node-зависимости не нужны: собранные CSS/JS уже лежат в `assets/`.

Логи PHP: `wordpress/wp-content/debug.log` внутри контейнера или
`docker compose exec wordpress tail -f wp-content/debug.log`.

После первоначальной установки база содержит только тестовые страницы и одну запись.
Чтобы заполнить все Carbon Fields, создать специалистов, цены, материалы, блог,
изображения и меню, выполните:

```bash
make seed
```

Сидер идемпотентен: повторный запуск обновляет те же записи и переиспользует
загруженные изображения. Скрипт находится в `docker/seed-demo.php`.

Форма обратной связи отправляет письма через Mailpit. После отправки формы
письмо появится на <http://localhost:8026>.

## Production deploy (SSH)

Production runs on an aaPanel server: WordPress at `/www/wwwroot/ormas.pro`, the theme is a
git clone at `wp-content/themes/ormas-pro` tracking `master` on GitHub.

Credentials are intentionally **not** stored in the repo. Pass one of:

```bash
export PROD_SSH_PASS='...'        # password (temporary askpass helper is created)
export PROD_SSH_KEY=~/.ssh/key    # or an ssh key
```

Commands (all go through `bin/prod-deploy.sh`):

```bash
make prod-status        # read-only: branch, HEAD, remote HEAD, dirty state, pending migrations
make prod-migrate-dry   # read-only: list pending DB migrations
make prod-deploy        # pull origin/master (reset), apply migrations, flush caches, health-check
make prod-migrations    # apply pending migrations only (no code update)
make prod-rollback      # reset theme code to the latest prod-backup-* tag + health-check
make prod-ssh           # interactive shell on the server
```

What `prod-deploy` does on the server:

1. refuses to run if the prod theme has tracked local changes;
2. fetches the branch over the public HTTPS URL (prod has no GitHub write credentials);
3. tags the current commit as `prod-backup-<timestamp>` (rollback point);
4. `git checkout -f <branch> && git reset --hard origin/<branch>`;
5. applies pending migrations from `db/migrations/` (see its README);
6. flushes WP cache/transients/rewrite rules and opcache;
7. checks that `https://ormas.pro` answers 200/301/302, otherwise exits non-zero.

Code rollback does **not** roll back applied DB migrations — migrations must therefore be
idempotent/forward-only (see `db/migrations/README.md`).
