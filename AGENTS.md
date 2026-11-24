# AGENTS.md

## Project Overview

WordPress theme for the ORMAS child-psychology center (`ormas.pro`), built on an own fork of
`underscores`. PHP 8.2 + Apache in Docker, MariaDB, Carbon Fields 3 for content, jQuery + slick
for carousels. The repo contains **only the theme** — WordPress core lives in containers.

Live dev site: <https://ormas.dev.inteli-dev.ru> (Traefik + Let's Encrypt).
Design source of truth: **Penpot** project, page `NEW version_v.7`, boards
`Главная — v8` (1920), `Главная_1024 — v8`, `Главная_768 — v8`, `Главная_320 — v8`,
plus `Компоненты — ОРМАС v8`. The old Figma file is retired — do not use it.

## Setup

```bash
cp .env.example .env          # already exists locally
make up                       # build/start WP + DB + Mailpit, install and seed demo
make seed                     # fill all Carbon Fields, specialists, prices, posts, images
```

- Admin: `https://ormas.dev.inteli-dev.ru/wp-admin/` — `admin` / `admin`
- Local on server: `http://localhost:8083` (redirects to the domain)
- Mailpit: `http://localhost:8026`
- Full reset (destroys DB volumes — ask the user first): `make reset && make up`

Compose details and the init/seed flow are in [README.DEV.md](README.DEV.md).

## Dev Loop

Code is bind-mounted, so PHP/CSS/JS changes are live after reload. CSS is cache-busted by
`filemtime` in `inc/enqueue.php`; hard-reload the browser after switching branches.

```bash
make ps                                   # container status
make logs                                 # WP + wp-init logs
make wp CMD="theme list"                  # wp-cli against the running site
make test                                 # smoke tests (HTTP, theme, pages, mail)
docker compose exec -T wordpress php -l wp-content/themes/ormas-pro/<file>.php
node --check assets/js/scripts.js         # after JS edits
curl -sS -o /dev/null -w '%{http_code}\n' https://ormas.dev.inteli-dev.ru/
```

Layout check without a browser:

```bash
B=~/.cache/ms-playwright/chromium_headless_shell-1254/chrome-headless-shell-linux64/chrome-headless-shell
timeout 120 "$B" --headless --disable-gpu --no-sandbox --hide-scrollbars \
  --window-size=1024,14000 --screenshot=/tmp/home-1024.png --virtual-time-budget=9000 \
  https://ormas.dev.inteli-dev.ru/
```

Use `127.0.0.1`-free URLs (the domain) for screenshots so fonts load without CORS issues.
Below-the-fold images are `loading="lazy"`; capture a tall viewport, not a scrolled iframe.

## Architecture Map

| Path | Role |
| --- | --- |
| `functions.php` | theme bootstrap; includes everything in `inc/` |
| `inc/enqueue.php` | asset registration and per-template guards |
| `assets/css/main.css` | legacy stylesheet for **all** pages (~13k lines, no SCSS source) |
| `assets/css/home-v8.css` | v8 home redesign, everything scoped under `body.home` |
| `assets/css/blog-cards.css` | square post cards, only on the `blog.php` page template |
| `template-parts/v8/hero.php`, `advantages.php` | Carbon-Fields-driven hero and advantages |
| `home.php` | front-page composition (hero → advantages → services → consultation → useful → specialists → reviews → posts → certificates → faq) |
| `template-parts/services.php` | services grid, price table, «Все услуги» CTA |
| `inc/custom-fields/main-page.php` | hero/advantages/form fields for the posts page |
| `inc/custom-fields/company-info.php` | theme options (phones, socials, WhatsApp) |
| `bin/dev-up.sh`, `bin/seed-demo.sh`, `bin/smoke-test.sh` | environment/seed/tests |

Asset guards: `home-v8.css` loads only when `is_home() || is_front_page()`; `blog-cards.css`
only for `is_page_template('blog.php')`. Any new global CSS must not leak into other templates.

## Styling Rules

- New home-only styles go to `assets/css/home-v8.css` and start with `body.home`. Other
  templates must render exactly as before — verify with a second template (e.g. `/service/`).
- Responsive breakpoints in this theme: `1440`, `1024` (laptop / tablet), `768` (tablet
  portrait), `600`, `450`; the mobile reference board is 320, the working mobile width 390.
  Check every section at 1024, 768 and 390 against the matching Penpot board.
- One vertical rhythm per section: a section **or** its inner wrapper owns the padding, never
  both (`certificates__wrapper`, `faq__home`, `useful`). Double padding is a regression.
- White card backgrounds are usually positioned `::before` layers. In-flow content under them
  needs `position: relative; z-index: 2`, or it renders invisible.
- Carousel navigation: arrows and dots live in one flex row inside `.slick-arrows`; slick is
  initialised in `assets/js/scripts.js` with `appendDots` for **both** posts and certificates.
  Change both initialisers together.
- Hero heading carries `<br class="v8-hero__br">` before «или»; it is hidden below 1024.
- Fonts: Nunito subsets in `assets/fonts/`, `@font-face` in `home-v8.css`; design tokens are
  CSS variables declared on `body.home`.

## Front-page guards (important)

`show_on_front = page` with an empty `page_on_front`: the homepage is the posts index, so
`is_home()` is `true` while `is_front_page()` is `false`. Guard all front-page-only code
(templates, CSS enqueue, header logo/WhatsApp social) with `is_home() || is_front_page()`.
Carbon Fields content for the homepage is stored on `page_for_posts` (page `glavnaya`).

## Verification Checklist

Before reporting a UI change as done:

1. `php -l` every changed PHP file; `node --check assets/js/scripts.js` when JS changed.
2. Home returns 200 on the domain, and one non-home template (e.g. `/service/`) still returns
   200 without `home-v8.css` in its HTML.
3. Screenshot the **changed section** at the widths it affects (1920 / 1024 / 768 / 390) and
   compare against the Penpot board of the same width. Check each section's own background,
   spacing and navigation, not just the whole page.
4. When a design value is uncertain, read it from Penpot (`mcp__penpot__export_shape`,
   `execute_code`) instead of guessing a colour or size.

## Deployment Notes

- The `wordpress` service carries Traefik labels for `ormas.dev.inteli-dev.ru` on the external
  `traefik-public` network; TLS is issued automatically.
- Site URL lives in the DB. Change it with
  `make wp CMD="option update home 'https://…'"`, `siteurl` likewise, then
  `make wp CMD="search-replace '<old>' '<new>' --all-tables-with-prefix --precise"`.
- WordPress runs behind the proxy; HTTPS is detected from `X-Forwarded-Proto`.

## Gotchas

- Do not mass-replace strings in `header.php` — it is 200+ lines of nested PHP and has been
  corrupted this way once; edit targeted blocks instead.
- Some theme/production CSS ships `!important` geometry (e.g. `img.logo-header-img { width:
  240px !important; height: 62px !important }`). When an element ignores your size, grep the
  live page's CSS and override with equal specificity + `!important`, scoped to `body.home`.
- `img` tags may carry inline `width`/`height` attributes; they participate in layout sizing —
  remove them when CSS should drive the aspect ratio.
- Slick clones slides; per-slide CSS should use classes on slides, and lazy images may stay
  blank in screenshots until the tall-viewport capture loads them.
- ReviewLab reviews are a web component with shadow DOM: inner text styles are not reachable
  from theme CSS.
