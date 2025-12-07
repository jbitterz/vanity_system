# Laravel Structure Plan (Vanity)

## Directories & Namespaces
- `app/Models`: `User`, `Product`, `Order`, `OrderItem`, `InventoryLog`, `Coupon`, `Address`.
- `app/Http/Controllers`: `AuthController`, `ProductController`, `CartController`, `CheckoutController`, `OrderController`, `Admin\ProductAdminController`, `Admin\OrderAdminController`.
- `app/Services`: `PricingService`, `InventoryService`, `CheckoutService`, `PaymentService` (Stripe wrapper).
- `app/Policies`: `OrderPolicy`, `ProductPolicy` for authorization.
- `routes/api.php`: REST endpoints; `routes/web.php` for Blade views.

## Migrations
1. `create_users_table`
2. `add_is_admin_to_users`
3. `create_addresses_table`
4. `create_products_table`
5. `create_orders_table`
6. `create_order_items_table`
7. `create_inventory_logs_table`
8. `create_coupons_table`

## Models & Relationships
- `User` hasMany `Order`, hasMany `Address`.
- `Order` belongsTo `User`, hasMany `OrderItem`.
- `OrderItem` belongsTo `Order` & `Product`.
- `Product` hasMany `OrderItem`, hasMany `InventoryLog`.

## Controllers (key methods)
- `AuthController@register/login/logout` using Laravel Breeze/Sanctum.
- `ProductController@index/show` (public) and admin CRUD (via policy/middleware).
- `CartController` optionally manages server-side carts using Redis/DB.
- `CheckoutController@store` handles validation + `CheckoutService` transaction.
- `OrderController@index/show` returns current user orders.
- `Admin\OrderAdminController@index/updateStatus` with filtering.

## CheckoutService Sketch
```php
public function checkout(User $user, array $cart, array $shipping, ?string $coupon)
{
    return DB::transaction(function () use ($user, $cart, $shipping, $coupon) {
        $products = Product::whereIn('id', array_column($cart, 'product_id'))
            ->lockForUpdate()->get();
        // validate and compute totals via PricingService
        $order = Order::create([...]);
        foreach ($cart as $line) {
            // create OrderItem, decrement stock, log inventory
        }
        // call PaymentService->charge()
        return $order->fresh('items');
    });
}
```

## Routes (api.php excerpt)
```php
Route::prefix('auth')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::get('products', [ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('cart', [CartController::class, 'show']);
    Route::post('cart', [CartController::class, 'store']);
    Route::delete('cart/{product}', [CartController::class, 'destroy']);
    Route::post('checkout', [CheckoutController::class, 'store']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{order}', [OrderController::class, 'show']);
});

Route::middleware(['auth:sanctum','can:manage-products'])->group(function(){
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{product}', [ProductController::class, 'update']);
    Route::delete('products/{product}', [ProductController::class, 'destroy']);
});
```

## Config & Env
- `.env`: `STRIPE_KEY`, `STRIPE_SECRET`, `SHIPPING_FEE`, `TAX_RATE`, `DISCOUNT_MODE`.
- `config/pricing.php` centralizes shipping/tax/coupon toggles.

## Testing
- Feature tests for auth, products, checkout transaction rollback, admin guards.
- Pest or PHPUnit with SQLite in-memory DB.
- Use factories + seeders for five brands sample data.
