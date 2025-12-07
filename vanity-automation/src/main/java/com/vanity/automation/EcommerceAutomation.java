package com.vanity.automation;

import com.microsoft.playwright.*;
import java.nio.file.Paths;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;

public class EcommerceAutomation {
    private final Playwright playwright;
    private final Browser browser;
    private final Page page;
    private final String baseUrl;
    private final DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyyMMdd_HHmmss");

    public EcommerceAutomation(String baseUrl) {
        this.baseUrl = baseUrl;
        this.playwright = Playwright.create();
        this.browser = playwright.chromium().launch(new BrowserType.LaunchOptions()
                .setHeadless(false)
                .setSlowMo(500)); // slow down for visibility
        this.page = browser.newPage();
    }

    private void log(String message) {
        System.out.println("[" + LocalDateTime.now().format(dtf) + "] " + message);
    }

    // ---------------- Registration ----------------
    public void registerUser(String fullName, String email, String password) {
        log("Navigating to registration page...");
        page.navigate(baseUrl + "/register");

        page.fill("input[name='full_name']", fullName);
        page.fill("input[name='email']", email);
        page.fill("input[name='password']", password);
        page.fill("input[name='password_confirmation']", password);

        log("Clicking Register button...");
        page.click("button:has-text('Register')");
        page.waitForTimeout(2000);

        Locator errorMsg = page.locator("text=The email has already been taken");
        if (errorMsg.isVisible()) {
            log("User already exists, skipping registration.");
        } else {
            page.waitForURL(url -> url.contains("/dashboard") || url.contains("/"));
            log("Registration successful!");
        }
    }

    // ---------------- Login ----------------
    public void login(String email, String password) {
        log("Navigating to login page...");
        page.navigate(baseUrl + "/login");

        page.fill("input[name='email']", email);
        page.fill("input[name='password']", password);

        log("Clicking Login button...");
        page.click("button[type='submit']");
        page.waitForURL(url -> url.contains("/dashboard") || url.contains("/"));
        log("Login successful!");
    }

    // ---------------- Add Products to Cart ----------------
    public void addProductsToCart(int count) {
        log("Navigating to products page...");
        page.navigate(baseUrl + "/products");

        page.waitForSelector("div.grid > div[class*='shadow']", 
            new Page.WaitForSelectorOptions().setTimeout(20000));

        Locator productLocator = page.locator("div.grid > div[class*='shadow']");
        int productCount = productLocator.count();
        log("Products detected: " + productCount);

        int added = 0;
        for (int i = 0; i < count; i++) {
            if (i >= productCount) {
                log("Not enough products found, stopping.");
                break;
            }

            Locator productCard = productLocator.nth(i);
            productCard.scrollIntoViewIfNeeded();
            page.waitForTimeout(500);

            Locator addButton = productCard.locator("button:has-text('Add to Cart')").first();
            boolean success = false;

            for (int retry = 0; retry < 5; retry++) {
                if (addButton.isVisible() && addButton.isEnabled()) {
                    addButton.scrollIntoViewIfNeeded();
                    addButton.click();
                    page.waitForTimeout(800);
                    log("Added product " + (i + 1) + " to cart.");
                    success = true;
                    added++;
                    break;
                }
                page.waitForTimeout(700);
            }

            if (!success) {
                log("Failed to click Add to Cart for product " + (i + 1));
            }
        }

        log("Finished adding products. Total added: " + added);
    }

    // ---------------- Cart & Checkout ----------------
    public void goToCart() {
        page.navigate(baseUrl + "/cart");
        page.waitForSelector("h2:has-text('Shopping Cart'), .cart-items", 
                new Page.WaitForSelectorOptions().setTimeout(5000));
        takeScreenshot("cart.png");
        log("Cart page loaded!");
    }

    public void proceedToCheckout() {
        Locator checkoutButton = page.locator("a[href*='checkout'], button:has-text('Proceed to Checkout')").first();
        if (checkoutButton.isVisible()) {
            checkoutButton.click();
            page.waitForURL(url -> url.contains("/checkout"));
            takeScreenshot("checkout_page.png");
            log("Checkout page loaded!");
        } else {
            log("Checkout button not found!");
        }
    }

    public void addAddress() {
        log("Navigating to profile to add address...");
        page.navigate(baseUrl + "/profile");
        page.waitForSelector("h2:has-text('Profile')", new Page.WaitForSelectorOptions().setTimeout(5000));
    
        // Click "Add New Address" link
        Locator addAddressLink = page.locator("a:has-text('Add New Address')").first();
        boolean clicked = false;
        for (int retry = 0; retry < 5; retry++) {
            addAddressLink.scrollIntoViewIfNeeded();
            page.waitForTimeout(500);
    
            if (addAddressLink.isVisible()) {
                addAddressLink.click();
                page.waitForTimeout(1000);
                log("'Add New Address' link clicked!");
                clicked = true;
                break;
            }
        }
        if (!clicked) {
            takeScreenshot("add_address_link_missing.png");
            log("'Add New Address' link not found or not clickable!");
            return;
        }
    
        // Fill in the address form
        log("Filling address form...");
        page.fill("input[name='label']", "Home");
        page.fill("input[name='line1']", "123 Sample Street");
        page.fill("input[name='line2']", "Unit 5B");
        page.fill("input[name='city']", "Quezon City");
        page.fill("input[name='region']", "NCR");
        page.fill("input[name='postal_code']", "1100");
        page.fill("input[name='country']", "Philippines");
    
        // Click Save Address button
        Locator saveBtn = page.locator("button:has-text('Save Address')").first();
        clicked = false;
        for (int retry = 0; retry < 5; retry++) {
            saveBtn.scrollIntoViewIfNeeded();
            page.waitForTimeout(500);
    
            if (saveBtn.isVisible()) {
                saveBtn.click();
                page.waitForTimeout(2000);
                log("Address saved successfully!");
                clicked = true;
                break;
            }
        }
        if (!clicked) {
            takeScreenshot("save_address_button_missing.png");
            log("Save Address button not found or not clickable!");
            return;
        }
    }
    

    public void fillCheckoutDetails(String fullName, String email, String phone) {
        page.fill("input[name='full_name']", fullName);
        page.fill("input[name='email']", email);
        page.fill("input[name='phone']", phone);

        Locator addressRadio = page.locator("input[name='address_id']").first();
        if (addressRadio.isVisible()) addressRadio.check();

        Locator paymentMethod = page.locator("input[name='payment_method'][value='cash_on_delivery']");
        if (paymentMethod.isVisible()) paymentMethod.check();

        log("Checkout details filled!");
    }

    public void placeOrder() {
        Locator placeOrderButton = page.locator("button:has-text('Place Order')").first();

        if (placeOrderButton.count() == 0 || !placeOrderButton.isVisible()) {
            log("Place Order button not found — likely missing address or not visible.");
            takeScreenshot("place_order_missing.png");
            return;
        }

        placeOrderButton.scrollIntoViewIfNeeded();
        placeOrderButton.click();
        page.waitForURL(url -> url.contains("/checkout/success") || url.contains("/orders"),
                new Page.WaitForURLOptions().setTimeout(15000));
        takeScreenshot("order_placed.png");
        log("Order placed successfully!");
    }

    public void viewOrderHistoryLink() {
        Locator viewOrderLink = page.locator("a:has-text('View Order History')").first();
        if (viewOrderLink.isVisible()) {
            viewOrderLink.scrollIntoViewIfNeeded();
            viewOrderLink.click();
            page.waitForSelector("h2:has-text('Order History'), .orders-list",
                    new Page.WaitForSelectorOptions().setTimeout(5000));
            takeScreenshot("order_history_link.png");
            log("Clicked 'View Order History' link and loaded orders page!");
        } else {
            log("'View Order History' link not found!");
        }
    }

    // ---------------- Full Flow ----------------
    public void runFullEcommerceFlow(String fullName, String email, String password, String phone) {
        login(email, password);
        addProductsToCart(2);
        goToCart();
        proceedToCheckout();
        addAddress();                 // ADD ADDRESS DURING CHECKOUT
        goToCart();                   // Go back to cart after adding address
        proceedToCheckout();
        fillCheckoutDetails(fullName, email, phone);
        placeOrder();
        viewOrderHistoryLink();       // Click "View Order History" after order
        log("E-commerce automation flow completed successfully!");
    }

    // ---------------- Utilities ----------------
    public void close() {
        if (browser != null) browser.close();
        if (playwright != null) playwright.close();
    }

    public void takeScreenshot(String filename) {
        page.screenshot(new Page.ScreenshotOptions().setPath(Paths.get(filename)).setFullPage(true));
    }
}
