#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."

if [ -f .env ]; then
  set -a
  # shellcheck disable=SC1091
  . ./.env
  set +a
fi

URL="${WP_URL:-http://localhost:${WP_PORT:-8083}}"

echo "Waiting for WordPress bootstrap..."
if ! timeout 300 docker compose wait wp-init >/dev/null; then
  echo "WordPress bootstrap (wp-init) failed" >&2
  docker compose logs --tail=80 wp-init >&2 || true
  exit 1
fi

for _ in $(seq 1 90); do
  body=$(curl -fsSL "$URL/" 2>/dev/null || true)
  if grep -q 'themes/ormas-pro' <<< "$body"; then
    echo "Site is ready: $URL"
    exit 0
  fi
  sleep 2
done

echo "Timed out waiting for $URL" >&2
docker compose logs --tail=80 wordpress wp-init >&2 || true
exit 1
