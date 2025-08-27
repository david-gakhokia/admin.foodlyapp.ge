Notifications Runbook — Admin reservation emails

Purpose

This runbook explains how to run the queue worker, configure mail, and run tests for the admin reservation email flow.

1) Environment

- Ensure `.env` contains working mail driver settings (for local testing you can use `log` or `smtp` with a test account):

  - MAIL_MAILER=smtp
  - MAIL_HOST=smtp.mailtrap.io (or your provider)
  - MAIL_PORT=587
  - MAIL_USERNAME=...
  - MAIL_PASSWORD=...
  - MAIL_ENCRYPTION=tls
  - MAIL_FROM_ADDRESS=notifications@example.com
  - MAIL_FROM_NAME="Foodly"

- Queue connection: prefer `database` or `redis` in production.
  - QUEUE_CONNECTION=database

2) Running the queue worker

- Database driver (database queue):

  php artisan queue:table
  php artisan migrate
  php artisan queue:work --sleep=3 --tries=3

- Redis driver:

  Set `QUEUE_CONNECTION=redis` and run:

  php artisan queue:work redis --sleep=3 --tries=3

- Use a process manager (supervisor/systemd) for production.

3) Running tests (locally)

- Unit tests added for Notifications are DB-less. Run only them quickly:

  php ./vendor/bin/pest tests/Unit/Notifications

4) Notification logs

- A DB table `notification_logs` was added to persist failed sends and permanent failures. To create the table run migrations:

  php artisan migrate

- The `SendAdminReservationEmail::failed()` handler will insert a record describing failures.

- The full test suite uses SQLite in-memory but some migrations use MySQL-only SQL (ALTER ... MODIFY) which causes failures on SQLite. For full test runs either:
  - Use a MySQL test DB and set the testing DB connection in `phpunit.xml` or `.env.testing`, or
  - Refactor migrations to avoid `MODIFY` statements incompatible with SQLite.

4) Troubleshooting

- If Mail facade errors appear in unit tests, ensure tests either use `Mail::fake()` or the unit tests remain DB-less and avoid Mail facade calls. The job and listener include safe fallbacks to execute in minimal environments.

5) Next improvements

- Add structured logging when recipients are missing or Mailer fails.
- Add more integration tests (Mail::fake + Bus::fake) using a MySQL test DB.
- Add rate-limiting/throttling for large batches.


Contact

If you want, I can implement the integration tests and a supervisor config snippet next.
