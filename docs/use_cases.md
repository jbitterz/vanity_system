# Vanity Use Cases & Flows

## Actors
- **Customer**: Browses catalog, manages cart, checks out, views orders.
- **Admin/Staff**: Manages products, stock, orders, and reporting.
- **Payment Gateway**: External service authorizing payments.

## Use Case List
1. **UC1  Register**: Customer submits email, password, full name. System validates, hashes password, and sends confirmation.
2. **UC2  Login**: Customer enters credentials, receives JWT/session token, and access/refresh tokens stored client-side.
3. **UC3  Browse Catalog**: User views paginated product list, filters by brand, searches by keyword. System caches results.
4. **UC4  View Product Detail**: User opens product page with description, price, stock indicator, and add-to-cart button.
5. **UC5  Manage Cart**: Add/update/remove items. System recalculates subtotals, enforces stock limits, and persists server-side per user.
6. **UC6  Checkout**: User reviews cart, enters shipping/payment. System validates stock, computes totals, processes payment, creates order.
7. **UC7  View Order History**: Authenticated user fetches their orders, filters by status/date, drills into order items.
8. **UC8  Admin Product CRUD**: Admin creates/updates/deletes products, uploads images, adjusts stock with optional reason.
9. **UC9  Admin Order Management**: Admin reviews orders, updates statuses (pendingpaidshippeddelivered/cancelled), and triggers notifications.

## Detailed Flow: UC6 Checkout
1. Customer clicks **Checkout** from cart page.
2. System preloads saved addresses; customer selects/edits shipping info.
3. Customer selects shipping method (Standard/Express) and applies coupons.
4. System fetches current product data and validates availability.
5. Pricing service recalculates subtotal, shipping fee, tax, discounts, final total.
6. Customer submits payment details; frontend posts to `/api/checkout`.
7. Backend starts DB transaction, revalidates stock, creates `orders` + `order_items`, decrements inventory, logs deltas.
8. Payment service charges card (Stripe). On success, order status  `paid`; on failure, transaction rolls back.
9. Confirmation (order id + transaction id) returned; frontend directs to receipt page and clears cart.

## Alternate / Error Flows
- **Stock Insufficient**: System rejects checkout with specific product errors and suggests quantity adjustments.
- **Payment Failure**: Order remains pending or cancelled; user prompted to retry with alternate method.
- **Address Validation Error**: Highlight invalid fields and block progression until corrected.

## Preconditions & Postconditions
- Customer must be authenticated for cart persistence and checkout.
- Products must exist and have stock > 0.
- Post-checkout: Order record persisted, inventory updated, confirmation logged, and optional email queued.
