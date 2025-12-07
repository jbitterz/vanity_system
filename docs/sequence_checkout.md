# Checkout Sequence (REST + DB)

1. **Client** submits `POST /api/checkout` with JWT, cart items, shipping data, payment token.
2. **API Middleware** authenticates token, loads user, validates payload via Form Request.
3. **CheckoutController@store**:
   - Queries products by IDs, maps to cart quantities.
   - Rejects if any product out of stock or inactive.
   - Computes subtotal, shipping (config-driven), taxes (based on region), discounts.
4. **DB Transaction begins**.
5. Insert row into `orders` (`status=pending`, subtotal, shipping_fee, tax_amount, total, address snapshot).
6. For each cart line:
   - Insert `order_items` with quantity, unit_price, line_total.
   - Update `products.stock = stock - quantity` with `where stock >= quantity` guard.
   - Insert `inventory_logs` entry capturing delta and reason `checkout`.
7. **Commit transaction** (if all succeed). On failure, rollback and return error.
8. **PaymentService** charges via Stripe:
   - On success  store `transaction_id`, update `orders.status = paid`.
   - On decline  set `status = cancelled`, restore stock deltas (compensating transaction) or rerun checkout after user retry.
9. **Response**: `{ order_id, status, subtotal, shipping_fee, tax_amount, total, transaction_id }`.
10. **Post-actions**: queue confirmation email, analytics event, optional webhook to OMS.

> This sequence ensures data integrity by limiting stock adjustments to the same transaction that persists the order.
