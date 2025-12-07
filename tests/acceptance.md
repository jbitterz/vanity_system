# Vanity Acceptance Test Plan

## Authentication
- **TC-AUTH-01** Register with valid email/password  201 Created, user record exists, welcome email queued.
- **TC-AUTH-02** Login with correct credentials  Receive JWT, protected endpoint access succeeds.
- **TC-AUTH-03** Login throttling after 5 failed attempts  429 response.

## Catalog & Cart
- **TC-CAT-01** List products filtered by brand `MAC`  Only MAC items returned, pagination metadata accurate.
- **TC-CAT-02** Add product with stock=1 twice  Second attempt fails with OUT_OF_STOCK error.
- **TC-CART-01** Update quantity to 0  Item removed, totals recalculated.

## Checkout
- **TC-CHK-01** Successful checkout with 2 items  Order stored, `orders.status=paid`, inventory decremented, inventory_logs entries created.
- **TC-CHK-02** Payment gateway failure  Order not persisted or marked cancelled, stock restored, user sees descriptive message.
- **TC-CHK-03** Concurrent checkout for same SKU (simulate race)  Only first succeeds; second receives stock error.

## Orders & History
- **TC-ORD-01** User fetches `/api/orders`  Only their orders returned.
- **TC-ORD-02** Unauthorized order access  403 via policy.

## Admin Functions
- **TC-ADM-01** Admin adds new product  Visible in catalog.
- **TC-ADM-02** Admin updates order status to shipped  Timestamp stored, webhook/event emitted.

## Logging & Analytics
- **TC-LOG-01** Checkout success writes log entry with order id and totals.
- **TC-LOG-02** Inventory adjustment via admin restock logs `reason=restock`.

## UI Smoke (Mockup)
- Responsive layout check: product grid collapses to single column <640px.
- Buttons accessible via keyboard, contrast passes WCAG AA.

## Performance
- Load test at 50 req/s for `/api/products`  <300ms avg response, error rate <1%.

## Acceptance Criteria Summary
- All critical paths above must pass.
- OWASP ZAP scan shows no high-severity findings.
- Deployment checklist completed with rollback plan verified.
