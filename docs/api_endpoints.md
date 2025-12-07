# Vanity REST API

## Auth
| Method | Path | Auth | Description |
| --- | --- | --- | --- |
| POST | /api/auth/register | Public | Body: `{ email, password, full_name }`. Returns user + JWT. |
| POST | /api/auth/login | Public | `{ email, password }`  `{ token, refresh_token }`. |
| POST | /api/auth/logout | JWT | Revokes token. |

## Products
| Method | Path | Auth | Notes |
| --- | --- | --- | --- |
| GET | /api/products | Optional | Query params: `brand`, `q`, `page`, `limit`, `sort`. Returns paginated list + metadata. |
| GET | /api/products/{id} | Optional | Single product details and stock flag. |
| POST | /api/products | Admin | Body includes `sku`, `name`, `brand`, `description`, `price`, `stock`, `image_url`. |
| PUT | /api/products/{id} | Admin | Update fields; logs stock delta if `stock` changes. |
| DELETE | /api/products/{id} | Admin | Soft delete recommended to preserve history. |

## Cart (server-backed option)
| Method | Path | Auth | Notes |
| --- | --- | --- | --- |
| GET | /api/cart | JWT | Returns user cart items + computed subtotal. |
| POST | /api/cart | JWT | Add/update items: `{ product_id, quantity }`. |
| DELETE | /api/cart/{product_id} | JWT | Remove item. |

## Checkout & Orders
| Method | Path | Auth | Notes |
| --- | --- | --- | --- |
| POST | /api/checkout | JWT | `{ cart: [...], shipping_address, shipping_method, payment_method, coupon }`. Returns order + totals + transaction id. |
| GET | /api/orders | JWT | Lists authenticated user orders; supports `status`, date filters. |
| GET | /api/orders/{id} | JWT | Requires order owner or admin. Includes items, taxes, shipping info. |

## Admin Orders
| Method | Path | Auth | Notes |
| --- | --- | --- | --- |
| GET | /api/admin/orders | Admin | Paginated search with filters (status, user, date). |
| PATCH | /api/admin/orders/{id}/status | Admin | `{ status }` transitions with validation (e.g., paidshipped). |
| GET | /api/admin/dashboard/stats | Admin | Aggregate KPIs (sales, top brands, low stock). |

## System
| Method | Path | Auth | Notes |
| --- | --- | --- | --- |
| GET | /api/config/pricing | JWT | Returns current shipping/tax configuration for client display. |
| GET | /health | Public | Health probe used by load balancer. |

### Error Model
```
{
  "status": "error",
  "code": "OUT_OF_STOCK",
  "message": "MAC Glow Serum only has 1 unit left",
  "details": { "product_id": 12, "available": 1 }
}
```

### Pagination Contract
```
{
  "data": [...],
  "meta": {
    "total": 125,
    "per_page": 12,
    "current_page": 2,
    "last_page": 11
  }
}
```
