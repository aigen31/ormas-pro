#!/usr/bin/env bash
# Smoke test for the local ormas.pro stack.
set -uo pipefail

cd "$(dirname "$0")/.."

if [ -f .env ]; then
  set -a
  # shellcheck disable=SC1091
  . ./.env
  set +a
fi

"$(dirname "$0")/wait-for-site.sh" >/dev/null || exit 1

URL="${WP_URL:-http://localhost:${WP_PORT:-8083}}"
MAILPIT_URL="http://localhost:${MAILPIT_PORT:-8026}"
PASS=0
FAIL=0
TMP_BODY=$(mktemp)
trap 'rm -f "$TMP_BODY"' EXIT

pass() { PASS=$((PASS + 1)); printf '  OK   %s\n' "$1"; }
fail() { FAIL=$((FAIL + 1)); printf '  FAIL %s\n' "$1"; }

check_status() {
  local name="$1" url="$2" expected="${3:-200}"
  local code
  code=$(curl -sS -o "$TMP_BODY" -w '%{http_code}' -L --max-time 20 "$url" || true)
  if [ "$code" = "$expected" ]; then
    pass "$name ($code)"
  else
    fail "$name (expected $expected, got $code) $url"
  fi
  return 0
}

check_contains() {
  local name="$1" url="$2" needle="$3"
  local body
  body=$(curl -fsSL --max-time 20 "$url" 2>/dev/null || true)
  if grep -q -- "$needle" <<< "$body"; then
    pass "$name"
  else
    fail "$name (missing: $needle) $url"
  fi
  return 0
}

echo "Testing $URL"

check_status "Homepage" "$URL/" 200
check_contains "Homepage uses ormas-pro theme" "$URL/" 'themes/ormas-pro/assets/css/main.css'
check_contains "Homepage contains site heading" "$URL/" 'Центр детской нейропсихологии ORMAS'
check_status "Theme CSS" "$URL/wp-content/themes/ormas-pro/assets/css/main.css" 200
check_status "Theme JS" "$URL/wp-content/themes/ormas-pro/assets/js/scripts.js" 200
check_status "WP login page" "$URL/wp-login.php" 200
check_status "REST API" "$URL/wp-json/" 200
check_status "Mailpit UI" "$MAILPIT_URL/" 200

for slug in \
  neuropsychology \
  psychological-support \
  logoped-defektolog \
  bos-therapy \
  nejrokorrekcziya \
  nejropsihologicheskaya-diagnostika \
  our-services \
  launch-speech; do
  check_status "Service page: $slug" "$URL/service/$slug/" 200
done

for slug in contacts reviews materialy agreement; do
  check_status "Page: $slug" "$URL/$slug/" 200
done

THEME=$(docker compose run --rm -T wp-cli theme list --status=active --field=name 2>/dev/null | tr -d '\r')
if [ "$THEME" = "ormas-pro" ]; then
  pass "Active theme is ormas-pro"
else
  fail "Active theme is ormas-pro (got: ${THEME:-none})"
fi

ROLES=$(docker compose run --rm -T wp-cli user get "${WP_ADMIN_USER:-admin}" --field=roles 2>/dev/null | tr -d '\r')
if grep -q 'administrator' <<< "$ROLES"; then
  pass "Admin user has administrator role"
else
  fail "Admin user has administrator role (got: ${ROLES:-none})"
fi

PERMALINKS=$(docker compose run --rm -T wp-cli option get permalink_structure 2>/dev/null | tr -d '\r')
if [ "$PERMALINKS" = "/%postname%/" ]; then
  pass "Pretty permalinks are enabled"
else
  fail "Pretty permalinks are enabled (got: ${PERMALINKS:-none})"
fi

ACTIVE_PLUGINS=$(docker compose run --rm -T wp-cli plugin list --status=active --field=name 2>/dev/null | tr -d '\r')
for plugin in cyr2lat svg-support; do
  if grep -qx "$plugin" <<< "$ACTIVE_PLUGINS"; then
    pass "Required plugin active: $plugin"
  else
    fail "Required plugin active: $plugin"
  fi
done

if docker compose exec -T wordpress sh -c 'test -f wp-content/debug.log && grep -qE "PHP Fatal error|PHP Parse error" wp-content/debug.log' >/dev/null 2>&1; then
  fail "PHP fatal/parse errors found in wp-content/debug.log"
else
  pass "No PHP fatal/parse errors in debug.log"
fi

echo
echo "Result: $PASS passed, $FAIL failed"
[ "$FAIL" -eq 0 ]
