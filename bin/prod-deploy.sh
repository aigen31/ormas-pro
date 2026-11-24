#!/usr/bin/env bash
#
# Production deploy / migrations helper for ormas.pro (aaPanel server).
#
# Usage:
#   bin/prod-deploy.sh status            # branch, HEAD, changed files, pending migrations (read-only)
#   bin/prod-deploy.sh migrations        # apply pending DB migrations only
#   bin/prod-deploy.sh migrations-dry    # list pending migrations only
#   bin/prod-deploy.sh deploy            # git pull (fast-forward reset) + migrations + cache flush + health check
#   bin/prod-deploy.sh rollback [tag]    # reset theme to the latest/last deploy backup tag
#   bin/prod-deploy.sh ssh               # interactive shell on the server
#
# Config (environment):
#   PROD_SSH        ssh destination               (default root@152.228.115.132)
#   PROD_SITE       WordPress root on server      (default /www/wwwroot/ormas.pro)
#   PROD_THEME      theme path relative to site   (default wp-content/themes/ormas-pro)
#   PROD_BRANCH     branch to deploy              (default master)
#   PROD_URL        health-check URL              (default https://ormas.pro)
#   PROD_SSH_KEY    path to a private key (optional)
#   PROD_SSH_PASS   ssh password (optional; a temporary askpass helper is used)
#
# Examples:
#   PROD_SSH_PASS='...' make prod-status
#   PROD_SSH_KEY=~/.ssh/ormas_prod make prod-deploy
#
set -euo pipefail

PROD_SSH="${PROD_SSH:-root@152.228.115.132}"
PROD_SITE="${PROD_SITE:-/www/wwwroot/ormas.pro}"
PROD_THEME_SUBDIR="${PROD_THEME:-wp-content/themes/ormas-pro}"
PROD_BRANCH="${PROD_BRANCH:-master}"
PROD_URL="${PROD_URL:-https://ormas.pro}"
PROD_GIT_URL="${PROD_GIT_URL:-https://github.com/aigen31/ormas-pro.git}"
PROD_SSH_KEY="${PROD_SSH_KEY:-}"
PROD_SSH_PASS="${PROD_SSH_PASS:-}"

REMOTE_THEME="$PROD_SITE/$PROD_THEME_SUBDIR"

usage() {
	sed -n '2,30p' "$0" | sed 's/^# \{0,1\}//'
	exit "${1:-1}"
}

if [[ $# -lt 1 ]]; then usage; fi
CMD="$1"; shift || true

# ---------------------------------------------------------------------------
# ssh plumbing (password OR key OR agent)
# ---------------------------------------------------------------------------
SSH_OPTS=(-F /dev/null -o StrictHostKeyChecking=accept-new -o ConnectTimeout=25 -o ServerAliveInterval=15)
ASKPASS_FILE=""
cleanup() { [[ -n "$ASKPASS_FILE" ]] && rm -f "$ASKPASS_FILE"; }
trap cleanup EXIT

if [[ -n "$PROD_SSH_PASS" ]]; then
	ASKPASS_FILE="$(mktemp "${TMPDIR:-/tmp}/ormas-askpass.XXXXXX")"
	chmod 700 "$ASKPASS_FILE"
	printf '#!/bin/sh\nprintf %%s %q\n' "$PROD_SSH_PASS" > "$ASKPASS_FILE"
	export SSH_ASKPASS="$ASKPASS_FILE"
	export SSH_ASKPASS_REQUIRE=force
	SSH=(setsid -w ssh "${SSH_OPTS[@]}")
else
	if [[ -n "$PROD_SSH_KEY" ]]; then
		SSH_OPTS+=(-i "$PROD_SSH_KEY" -o IdentitiesOnly=yes)
	fi
	SSH=(ssh "${SSH_OPTS[@]}")
fi

run_remote() {
	"${SSH[@]}" "$PROD_SSH" bash -s -- \
		"$REMOTE_THEME" "$PROD_SITE" "$PROD_BRANCH" "$PROD_URL" "$PROD_GIT_URL" "$@" <<'REMOTE'
set -euo pipefail

THEME="$1"; SITE="$2"; BRANCH="$3"; URL="$4"; GIT_URL="$5"; shift 5
CMD="${1:-status}"; shift || true

cd "$THEME"

wpcmd() { wp --path="$SITE" --allow-root "$@"; }

fail() { echo "ERROR: $*" >&2; exit 1; }

# --- migrations -------------------------------------------------------------
migration_files() {
	find "$THEME/db/migrations" -maxdepth 1 -type f \
		\( -name '[0-9]*.sql' -o -name '[0-9]*.php' \) 2>/dev/null | sort
}

applied_sha() { # $1 file name -> prints sha1 stored on prod ("" if never applied)
	MIG_FILE="$1" wpcmd eval '
		$f = getenv("MIG_FILE");
		$m = get_option("ormas_migrations", array());
		if (isset($m[$f]["sha1"])) { echo $m[$f]["sha1"]; }
	' 2>/dev/null || true
}

mark_applied() { # $1 file name, $2 sha1
	MIG_FILE="$1" MIG_SHA="$2" wpcmd eval '
		$f = getenv("MIG_FILE");
		$m = get_option("ormas_migrations", array());
		$m[$f] = array("sha1" => getenv("MIG_SHA"), "at" => current_time("mysql"));
		update_option("ormas_migrations", $m, false);
	'
}

pending_migrations() { # prints PENDING/CHANGED lines; returns 1 if any CHANGED
	local changed=0
	local f base sha prev
	while IFS= read -r f; do
		[[ -n "$f" ]] || continue
		base="$(basename "$f")"
		sha="$(sha1sum "$f" | cut -d' ' -f1)"
		prev="$(applied_sha "$base")"
		if [[ "$prev" == "$sha" ]]; then
			continue
		fi
		if [[ -n "$prev" && "$prev" != "$sha" ]]; then
			echo "CHANGED $base  (already applied, file was edited — apply manually)"
			changed=1
			continue
		fi
		echo "PENDING $base"
	done < <(migration_files)
	return "$changed"
}

apply_migrations() {
	local f base sha prev
	while IFS= read -r f; do
		[[ -n "$f" ]] || continue
		base="$(basename "$f")"
		sha="$(sha1sum "$f" | cut -d' ' -f1)"
		prev="$(applied_sha "$base")"
		[[ "$prev" == "$sha" ]] && continue
		[[ -n "$prev" ]] && fail "migration $base was already applied with a different checksum"
		echo ">> applying $base"
		case "$f" in
			*.sql) wpcmd db query < "$f" ;;
			*.php) wpcmd eval-file "$f" ;;
		esac
		mark_applied "$base" "$sha"
	done < <(migration_files)
}

flush_caches() {
	wpcmd cache flush >/dev/null 2>&1 || true
	wpcmd transient delete --all >/dev/null 2>&1 || true
	wpcmd rewrite flush --hard >/dev/null 2>&1 || true
	wpcmd eval 'if (function_exists("opcache_reset")) { @opcache_reset(); }' >/dev/null 2>&1 || true
}

health_check() {
	local code
	code="$(curl -sS -o /dev/null -m 20 -w '%{http_code}' "$URL" || true)"
	echo "health: $URL -> ${code:-no response}"
	[[ "$code" == 200 || "$code" == 301 || "$code" == 302 ]]
}

require_git() {
	git rev-parse --git-dir >/dev/null 2>&1 || fail "$THEME is not a git repository"
}

cmd_status() {
	require_git
	echo "theme:  $THEME"
	echo "branch: $(git rev-parse --abbrev-ref HEAD)"
	echo "head:   $(git log -1 --format='%h %ad %s' --date=short)"
	if git fetch "$GIT_URL" "+refs/heads/$BRANCH:refs/remotes/origin/$BRANCH" >/dev/null 2>&1; then
		echo "remote: origin/$BRANCH -> $(git log -1 --format='%h %ad %s' --date=short "origin/$BRANCH")"
	else
		echo "remote: fetch failed ($GIT_URL)"
	fi
	if [[ -n "$(git status --porcelain --untracked-files=no)" ]]; then
		echo "dirty:  $(git status --porcelain --untracked-files=no | head -5 | tr '\n' ' ')"
	else
		echo "dirty:  no"
	fi
	echo "migrations:"
	local migs
	migs="$(pending_migrations || true)"
	if [[ -z "$migs" ]]; then echo "  (none)"; else echo "$migs" | sed 's/^/  /'; fi
}

cmd_migrations_dry() {
	echo "pending migrations:"
	local out
	out="$(pending_migrations || true)"
	if [[ -z "$out" ]]; then echo "  (none)"; else echo "$out" | sed 's/^/  /'; fi
}

cmd_migrations() {
	echo "applying migrations…"
	apply_migrations
	echo "migrations done"
}

cmd_deploy() {
	require_git
	[[ -z "$(git status --porcelain --untracked-files=no)" ]] || fail "prod theme has tracked local changes — refusing to deploy"
	local prev target tag
	prev="$(git rev-parse HEAD)"
	git fetch "$GIT_URL" "+refs/heads/$BRANCH:refs/remotes/origin/$BRANCH"
	target="$(git rev-parse "origin/$BRANCH")"
	if [[ "$prev" == "$target" ]]; then
		echo "code already at origin/$BRANCH ($(git log -1 --format='%h %s' "$prev"))"
	else
		tag="prod-backup-$(date +%Y%m%d-%H%M%S)"
		git tag -f "$tag" "$prev" >/dev/null
		echo "code: $prev -> $target (backup tag: $tag)"
		if git show-ref --verify --quiet "refs/heads/$BRANCH"; then
			git checkout -q -f "$BRANCH"
		else
			git checkout -q -B "$BRANCH" "$target"
		fi
		git reset --hard "$target" >/dev/null
	fi
	apply_migrations
	flush_caches
	health_check || fail "health check failed after deploy"
	echo "deploy OK ($(git log -1 --format='%h %s'))"
}

cmd_rollback() {
	require_git
	local tag="${1:-}"
	if [[ -z "$tag" ]]; then
		tag="$(git tag -l 'prod-backup-*' --sort=-creatordate | head -1)"
	fi
	[[ -n "$tag" ]] || fail "no prod-backup-* tag found"
	echo "rolling back to $tag"
	git checkout -q -f "$(git rev-parse --abbrev-ref HEAD)" 2>/dev/null || true
	git reset --hard "$tag"
	flush_caches
	health_check || fail "health check failed after rollback"
	echo "rollback OK ($tag)"
}

case "$CMD" in
	status) cmd_status ;;
	migrations) cmd_migrations ;;
	migrations-dry|migrate-dry) cmd_migrations_dry ;;
	deploy) cmd_deploy ;;
	rollback) cmd_rollback "$@" ;;
	*) fail "unknown remote command: $CMD" ;;
esac
REMOTE
}

case "$CMD" in
	status) run_remote status ;;
	migrations) run_remote migrations ;;
	migrations-dry|migrate-dry) run_remote migrations-dry ;;
	deploy) run_remote deploy ;;
	rollback) run_remote rollback "$@" ;;
	ssh)
		if [[ -n "$PROD_SSH_PASS" ]]; then
			"${SSH[@]}" -t "$PROD_SSH"
		else
			exec "${SSH[@]}" "$PROD_SSH"
		fi
		;;
	help|-h|--help) usage 0 ;;
	*) usage ;;
esac
