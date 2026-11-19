#!/bin/sh
# Idempotent local WordPress bootstrap for the ormas.pro theme.
set -eu

WP_PATH=/var/www/html
WP_URL="${WP_URL:-http://localhost:8083}"
WP_TITLE="${WP_TITLE:-ORMAS Local}"
WP_ADMIN_USER="${WP_ADMIN_USER:-admin}"
WP_ADMIN_PASSWORD="${WP_ADMIN_PASSWORD:-admin}"
WP_ADMIN_EMAIL="${WP_ADMIN_EMAIL:-admin@example.com}"

log() {
  printf '[ormas-init] %s\n' "$*"
}

# The wordpress container copies core files and generates wp-config.php first.
i=0
while [ ! -f "$WP_PATH/wp-config.php" ]; do
  i=$((i + 1))
  if [ "$i" -gt 90 ]; then
    log "Timed out waiting for wp-config.php"
    exit 1
  fi
  sleep 2
done

i=0
until wp db check --path="$WP_PATH" >/dev/null 2>&1; do
  i=$((i + 1))
  if [ "$i" -gt 60 ]; then
    log "Timed out waiting for the database"
    exit 1
  fi
  sleep 2
done

if ! wp core is-installed --path="$WP_PATH" >/dev/null 2>&1; then
  log "Installing WordPress at $WP_URL"
  wp core install \
    --path="$WP_PATH" \
    --url="$WP_URL" \
    --title="$WP_TITLE" \
    --admin_user="$WP_ADMIN_USER" \
    --admin_password="$WP_ADMIN_PASSWORD" \
    --admin_email="$WP_ADMIN_EMAIL" \
    --skip-email
else
  log "WordPress is already installed"
fi

wp option update home "$WP_URL" --path="$WP_PATH" >/dev/null
wp option update siteurl "$WP_URL" --path="$WP_PATH" >/dev/null
wp option update blogname "$WP_TITLE" --path="$WP_PATH" >/dev/null
wp option update blogdescription "Центр детской нейропсихологии" --path="$WP_PATH" >/dev/null
wp option update timezone_string "Europe/Moscow" --path="$WP_PATH" >/dev/null
wp option update date_format "d.m.Y" --path="$WP_PATH" >/dev/null
wp option update show_on_front "posts" --path="$WP_PATH" >/dev/null
wp option update permalink_structure "/%postname%/" --path="$WP_PATH" >/dev/null

log "Activating theme ormas-pro"
wp theme activate ormas-pro --path="$WP_PATH"

install_plugin() {
  plugin="$1"
  fallback_url="${2:-}"

  if wp plugin is-installed "$plugin" --path="$WP_PATH" >/dev/null 2>&1; then
    wp plugin activate "$plugin" --path="$WP_PATH" >/dev/null 2>&1 || true
    return 0
  fi

  if ! wp plugin install "$plugin" --activate --path="$WP_PATH"; then
    # The WordPress.org plugin API is sometimes unavailable from containers;
    # the download CDN usually still works.
    if [ -n "$fallback_url" ] && wp plugin install "$fallback_url" --activate --path="$WP_PATH"; then
      return 0
    fi
    log "WARNING: could not install plugin $plugin (offline?)"
  fi
}

install_plugin cyr2lat "https://downloads.wordpress.org/plugin/cyr2lat.zip"
install_plugin svg-support "https://downloads.wordpress.org/plugin/svg-support.zip"

create_post() {
  post_type="$1"
  slug="$2"
  title="$3"

  existing_id=$(wp post list \
    --path="$WP_PATH" \
    --post_type="$post_type" \
    --post_status=any \
    --name="$slug" \
    --posts_per_page=1 \
    --field=ID 2>/dev/null || true)

  if [ -z "$existing_id" ]; then
    wp post create \
      --path="$WP_PATH" \
      --post_type="$post_type" \
      --post_status=publish \
      --post_title="$title" \
      --post_name="$slug" \
      --porcelain >/dev/null
    log "Created $post_type/$slug"
  fi
}

# Slugs are used by single-service_pages.php to choose a template.
create_post service_pages neuropsychology "Нейропсихология"
create_post service_pages psychological-support "Психологическое сопровождение"
create_post service_pages logoped-defektolog "Логопед-дефектолог"
create_post service_pages bos-therapy "БОС-терапия"
create_post service_pages nejrokorrekcziya "Нейрокоррекция"
create_post service_pages nejropsihologicheskaya-diagnostika "Нейропсихологическая диагностика"
create_post service_pages our-services "Наши услуги"
create_post service_pages launch-speech "Запуск речи"

# Slugs are used by page-{slug}.php templates.
create_post page contacts "Контакты"
create_post page reviews "Отзывы"
create_post page materialy "Материалы"
create_post page agreement "Пользовательское соглашение"

# At least one post makes the blog loop on the homepage non-empty.
if [ -z "$(wp post list --path="$WP_PATH" --post_type=post --posts_per_page=1 --field=ID 2>/dev/null)" ]; then
  wp post create \
    --path="$WP_PATH" \
    --post_type=post \
    --post_status=publish \
    --post_title="Добро пожаловать в ORMAS" \
    --post_content="Это тестовая запись локальной среды разработки." \
    --porcelain >/dev/null
  log "Created a sample blog post"
fi

wp rewrite flush --hard --path="$WP_PATH" >/dev/null

log "Ready: $WP_URL (admin: $WP_ADMIN_USER / $WP_ADMIN_PASSWORD)"
