# Database migrations (production)

Migrations are applied automatically by `make prod-deploy` / `bin/prod-deploy.sh`
right after the theme is updated, and can be run alone with `make prod-migrate`.

Naming (applied in lexicographic order):

```
NNNN_short_description.sql   -- raw SQL, executed via `wp db query <file>`
NNNN_short_description.php   -- PHP, executed via `wp eval-file <file>` inside WordPress
```

Rules:

- Append-only: never edit a migration that has already been applied on production
  (the runner stores a sha1 of every applied file and aborts on a mismatch).
- SQL migrations must be idempotent where possible (`CREATE TABLE IF NOT EXISTS`,
  `INSERT ... ON DUPLICATE KEY UPDATE`), because a rollback/redeploy can replay a
  failed batch.
- PHP migrations run with full WordPress loaded (`$wpdb`, options, Carbon Fields).
- Keep migrations small and single-purpose; name them with a zero-padded number.
- State is tracked in the `ormas_migrations` option:
  `{ "<file>": { "sha1": "...", "at": "YYYY-MM-DD HH:MM:SS" } }`.

Check what is pending on production without changing anything:

```bash
make prod-status       # code + pending migrations
make prod-migrate-dry  # pending migrations only
```
