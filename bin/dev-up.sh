#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."

docker compose up -d --build

"$(dirname "$0")/wait-for-site.sh"
