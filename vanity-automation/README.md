# Vanity E-commerce Automation Script

This Java project uses **Selenium WebDriver** to automate the e-commerce workflow on the Vanity makeup site.

## Prerequisites

* Java 11 or higher
* Maven
* Chrome browser
* XAMPP with the Vanity Laravel application running on `http://localhost/8000`

## Setup

1. Ensure the Vanity Laravel application is running on XAMPP at `http://localhost/8000`.
2. The script will register a new test user automatically, but you can provide your own email and password if desired.
3. The user should have at least one saved address for checkout (the script can also add a new address).

## Running the Automation

```bash
cd vanity-automation
mvn clean compile exec:java -Dexec.mainClass="com.vanity.automation.RunEcommerceAutomation"
```

## What the Script Does

1. **Register User**: Creates a new user with a unique email if it doesn't already exist.
2. **Login**: Logs in with the registered credentials.
3. **Add Products to Cart**: Navigates to the products page and adds a specified number of products to the cart.
4. **View Cart**: Navigates to the cart page and takes a screenshot.
5. **Proceed to Checkout**: Clicks the checkout link/button.
6. **Add Address**: Fills in shipping address details if none exist.
7. **Fill Checkout Details**: Ensures contact information is filled.
8. **Place Order**: Completes the checkout process.
9. **View Order History**: Opens the order history page and logs all orders.
10. **Screenshots**: Takes screenshots at key steps (cart, checkout, order confirmation).

## Dependencies

* Selenium WebDriver 4.16.1
* WebDriverManager 5.5.3 (for automatic ChromeDriver management)
* JUnit 5.10.0 (optional, for testing)

## Notes

* The script uses **explicit waits** to handle dynamic page loading.
* It automatically scrolls and hovers over product cards to ensure "Add to Cart" buttons are clickable.
* Address and contact information can be pre-filled or added by the script.
* Payment method defaults to "Cash on Delivery".
* Screenshots are saved in the project root with timestamps for reference.


