# Vanity Architecture Overview

## Component View
- **Client UI**: Responsive web app (React or Blade). Handles authentication tokens, catalog browsing, cart state (local or server-backed), and checkout forms.
- **API Gateway**: Laravel API routes grouped under `/api`. Applies rate limiting, auth middleware (JWT or Sanctum), and validation.
- **Application Services**: Controllers delegate to service classes for catalog, cart, pricing, checkout, and admin operations. Policies enforce RBAC between customers and admins.
- **Domain Models**: `User`, `Product`, `Order`, `OrderItem`, `InventoryLog`, `Address`. Encapsulate pricing, stock deductions, and status transitions.
- **Persistence**: MySQL/MariaDB with migrations and seeders. SQLite supported for dev/testing. Uses transactions for checkout and row-level locking for stock updates.
- **Payment Integration**: Stripe (or mock) via service wrapper. Supports async webhooks to reconcile payments.
- **Background Jobs**: Laravel queues (Redis/SQS) send emails, handle webhooks, and perform stock audits.
- **Observability**: Monolog structured logs, Laravel Horizon metrics, health check endpoint consumed by uptime monitor.

## Deployment Topology
1. **Frontend** served via CDN or Laravel asset pipeline.
2. **API** hosted on PHP-FPM + Nginx/Apache (Docker or VM). Horizontal scaling with load balancer; sticky sessions not required when using token auth.
3. **Database** on managed MySQL with automated backups and read replica for analytics.
4. **Cache/Queue** using Redis for sessions, cache tags, and queues.
5. **Object Storage** (S3/MinIO) for product imagery (optional at MVP).

## Security Considerations
- HTTPS everywhere, HSTS enabled.
- Secrets (DB, Stripe keys) stored in `.env` and secret managers.
- Input validation + sanitization (Laravel Form Requests).
- Role policies for admin-only endpoints.
- Activity logging for checkouts and stock adjustments stored in `inventory_logs` plus application log.

## Scaling & Performance
- Use pagination for catalog endpoints, caching for popular queries.
- Queue expensive tasks (emails, reports).
- Database indexes on `products.brand`, `orders.user_id`, `order_items.order_id`.
- Load tests prior to launch to ensure <500ms P95 response.

## Backup & Recovery
- Daily automated DB snapshots + point-in-time recovery.
- Storage versioning for product images.
- Run disaster recovery drill quarterly using infrastructure-as-code.
