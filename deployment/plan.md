# Vanity Deployment Plan

## Environments
1. **Local**: Laravel Sail or XAMPP + SQLite. `.env.local` with mock Stripe keys.
2. **Staging**: Dockerized Laravel + MySQL, seeded sample data, Stripe test keys, QA accounts.
3. **Production**: Managed MySQL, Redis, S3, Stripe live keys.

## Prerequisites
- Git repo initialized with CI (GitHub Actions/GitLab CI) running tests + Pint + Pest.
- Secrets stored in CI and infrastructure secret manager.
- Domain + SSL cert (Lets Encrypt/ACM) ready.

## Deployment Steps
1. Build frontend assets (`npm run build`) and backend (`composer install --no-dev`).
2. Run automated tests.
3. Package Docker image or artifact.
4. Apply database migrations (`php artisan migrate --force`).
5. Seed baseline data (brands/products) via `php artisan db:seed --class=ProductSeeder` (once).
6. Cache config/routes (`php artisan config:cache`, `route:cache`).
7. Deploy image to container platform or copy artifacts to server.
8. Warm up cache (`php artisan optimize`), restart queue workers/Horizon.

## Rollback Strategy
- Keep previous release artifacts; use blue/green or symlink swap.
- Automated DB backups before migrations; emergency rollback via restore + replay logs.

## Monitoring & Alerts
- Health check endpoint `/health` polled every 1 min.
- Application logs shipped to ELK/CloudWatch.
- Alerts on checkout failure rate, stock mismatch, high latency.

## Next Steps / Backlog
- Implement payment webhooks for asynchronous confirmation.
- Add recommendation engine + wishlist.
- Build admin analytics dashboards.
- Automate load tests in CI pipeline.
