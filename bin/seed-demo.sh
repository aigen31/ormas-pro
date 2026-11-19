#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."

"$(dirname "$0")/wait-for-site.sh" >/dev/null

docker compose run --rm -T wp-cli eval-file \
  /var/www/html/wp-content/themes/ormas-pro/docker/seed-demo.php

docker compose run --rm -T wp-cli eval-file \
  /var/www/html/wp-content/themes/ormas-pro/docker/verify-seed.php
