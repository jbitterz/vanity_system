This Java project uses Selenium WebDriver to automate the e-commerce workflow on the Vanity makeup site.

## Prerequisites

- Java 11 or higher
- Maven
- Chrome browser
- XAMPP with the Vanity Laravel application running on `http://localhost/vanity`

## Setup

1. Ensure the Vanity Laravel application is running on XAMPP at `http://localhost/vanity`
2. Make sure there's a test user with email `test@example.com` and password `password`
3. The user should have at least one saved address for checkout

## Running the Automation

```bash
cd vanity-automation
mvn clean compile exec:java -Dexec.mainClass="com.vanity.automation.EcommerceAutomation"
```

## Running the Browser Installer

```bash
cd vanity-automation
mvn clean compile exec:java -Dexec.mainClass="com.vanity.InstallBrowsers"
```

## What the Script Does

1. **Login**: Logs in with test credentials
2. **Add to Cart**: Navigates to products page and adds the first available product to cart
3. **View Cart**: Goes to the cart page
4. **Proceed to Checkout**: Clicks the checkout link
5. **Fill Checkout Details**: Ensures contact information is filled and places the order
6. **View Order History**: Navigates to the orders page to view order history

## Dependencies

- Selenium WebDriver 4.15.0
- WebDriverManager 5.5.3 (for automatic ChromeDriver management)
- JUnit 5.10.0 (for testing)

## Notes

- The script assumes product ID 1 exists and is in stock
- Contact information fields are pre-filled from user profile, but the script ensures they have values
- Payment method defaults to "Cash on Delivery"
- The script uses explicit waits to handle dynamic page loading
=======
# Vanity E-commerce Automation Script

This Java project uses Playwright to automate the e-commerce workflow on the Vanity makeup site.

## Prerequisites

- Java 11 or higher
- Maven
- Chrome browser (Playwright will install it automatically)
- XAMPP with the Vanity Laravel application running on `http://localhost/vanity`

## Setup

1. Ensure the Vanity Laravel application is running on XAMPP at `http://localhost/vanity`
2. Make sure there's a test user with email `test@example.com` and password `password`
3. The user should have at least one saved address for checkout

## Running the Automation

```bash
cd vanity-automation
mvn clean compile exec:java -Dexec.mainClass="com.vanity.automation.EcommerceAutomation"
```

## What the Script Does

1. **Login**: Logs in with test credentials
2. **Add to Cart**: Navigates to products page and adds the first available product to cart
3. **View Cart**: Goes to the cart page
4. **Proceed to Checkout**: Clicks the checkout link
5. **Fill Checkout Details**: Ensures contact information is filled and places the order
6. **View Order History**: Navigates to the orders page to view order history

## Dependencies

- Playwright for Java 1.40.0
- JUnit 5.10.0 (for testing)

## Notes

- Playwright automatically manages browser binaries
- The script assumes the first product on the page is available
- Contact information fields are pre-filled from user profile, but the script ensures they have values
- Payment method defaults to "Cash on Delivery"
- The script uses auto-waiting capabilities of Playwright for reliable element interaction
