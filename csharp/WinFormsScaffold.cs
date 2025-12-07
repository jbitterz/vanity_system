// Vanity Ordering System - Windows Forms scaffold
namespace Vanity.WinForms
{
    public class User
    {
        public long Id { get; set; }
        public string Email { get; set; } = string.Empty;
        public string FullName { get; set; } = string.Empty;
        public bool IsAdmin { get; set; }
    }

    public class Product
    {
        public long Id { get; set; }
        public string Name { get; set; } = string.Empty;
        public string Brand { get; set; } = string.Empty;
        public decimal Price { get; set; }
        public int Stock { get; set; }
    }

    public class Order
    {
        public long Id { get; set; }
        public long UserId { get; set; }
        public decimal Subtotal { get; set; }
        public decimal Shipping { get; set; }
        public decimal Tax { get; set; }
        public decimal Total { get; set; }
        public string Status { get; set; } = "pending";
    }

    public class OrderItem
    {
        public long Id { get; set; }
        public long OrderId { get; set; }
        public long ProductId { get; set; }
        public int Quantity { get; set; }
        public decimal UnitPrice { get; set; }
        public decimal LineTotal => UnitPrice * Quantity;
    }

    // Form suggestions (pseudo-code mapping)
    // FormLogin: txtEmail, txtPassword, btnLogin, btnSignup
    // FormCatalog: dgvProducts, txtSearch, cmbBrand, btnAddToCart
    // FormCart: dgvCart, lblSubtotal, lblShipping, lblTax, lblTotal, btnCheckout
    // FormCheckout: address inputs, payment controls, btnConfirm
}
