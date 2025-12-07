package com.vanity.automation;

import io.github.bonigarcia.wdm.WebDriverManager;
import org.openqa.selenium.*;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.nio.file.Paths;
import java.time.Duration;
import java.time.LocalDateTime;
import java.time.format.DateTimeFormatter;
import java.util.List;
import java.io.File;
import java.io.IOException;

public class EcommerceAutomation {

    private final WebDriver driver;
    private final WebDriverWait wait;
    private final Actions actions;
    private final String baseUrl;
    private final DateTimeFormatter dtf = DateTimeFormatter.ofPattern("yyyyMMdd_HHmmss");

    public EcommerceAutomation(String baseUrl) {
        this.baseUrl = baseUrl;
        WebDriverManager.chromedriver().setup();
        driver = new ChromeDriver();
        driver.manage().window().maximize();
        wait = new WebDriverWait(driver, Duration.ofSeconds(10));
        actions = new Actions(driver);
    }

    private void log(String message) {
        System.out.println("[" + LocalDateTime.now().format(dtf) + "] " + message);
    }

    // ---------------- Registration ----------------
    public void registerUser(String fullName, String email, String password) {
        log("Navigating to registration page...");
        driver.get(baseUrl + "/register");

        driver.findElement(By.name("full_name")).sendKeys(fullName);
        driver.findElement(By.name("email")).sendKeys(email);
        driver.findElement(By.name("password")).sendKeys(password);
        driver.findElement(By.name("password_confirmation")).sendKeys(password);

        log("Clicking Register button...");
        driver.findElement(By.xpath("//button[contains(text(),'Register')]")).click();

        try { Thread.sleep(2000); } catch (InterruptedException ignored) {}

        List<WebElement> errorMsg = driver.findElements(By.xpath("//*[contains(text(),'The email has already been taken')]"));
        if (!errorMsg.isEmpty() && errorMsg.get(0).isDisplayed()) {
            log("User already exists, skipping registration.");
        } else {
            wait.until(ExpectedConditions.or(
                    ExpectedConditions.urlContains("/dashboard"),
                    ExpectedConditions.urlContains("/")
            ));
            log("Registration successful!");
        }
    }

    // ---------------- Login ----------------
    public void login(String email, String password) {
        log("Navigating to login page...");
        driver.get(baseUrl + "/login");

        driver.findElement(By.name("email")).sendKeys(email);
        driver.findElement(By.name("password")).sendKeys(password);

        log("Clicking Login button...");
        driver.findElement(By.cssSelector("button[type='submit']")).click();

        wait.until(ExpectedConditions.or(
                ExpectedConditions.urlContains("/dashboard"),
                ExpectedConditions.urlContains("/")
        ));
        log("Login successful!");
    }

    // ---------------- Add Products ----------------
    public void addProductsToCart(int count) {
        driver.get(baseUrl + "/products");
        wait.until(ExpectedConditions.presenceOfAllElementsLocatedBy(By.cssSelector("div.group")));

        List<WebElement> productCards = driver.findElements(By.cssSelector("div.group"));
        int added = 0;

        for (int i = 0; i < count && i < productCards.size(); i++) {
            WebElement card = productCards.get(i);
            try {
                actions.moveToElement(card).perform();
                Thread.sleep(300);

                WebElement addButton = card.findElement(By.cssSelector("form button[type='submit']"));
                ((JavascriptExecutor) driver).executeScript("arguments[0].scrollIntoView(true);", addButton);
                wait.until(ExpectedConditions.elementToBeClickable(addButton));
                addButton.click();
                Thread.sleep(500);

                log("Added product " + (i + 1) + " to cart.");
                added++;
            } catch (Exception e) {
                log("Error adding product " + (i + 1) + ": " + e.getMessage());
            }
        }

        log("Finished adding products. Total added: " + added);
    }
    // ---------------- Cart & Checkout ----------------
    public void goToCart() {
        driver.get(baseUrl + "/cart");
        wait.until(ExpectedConditions.presenceOfElementLocated(By.cssSelector(".cart-items, h2")));
        takeScreenshot("cart.png");
        log("Cart page loaded!");
    }

    public void proceedToCheckout() {
        List<WebElement> checkoutButtons = driver.findElements(By.xpath("//a[contains(@href,'checkout')] | //button[contains(text(),'Proceed to Checkout')]"));
        if (!checkoutButtons.isEmpty() && checkoutButtons.get(0).isDisplayed()) {
            checkoutButtons.get(0).click();
            wait.until(ExpectedConditions.urlContains("/checkout"));
            takeScreenshot("checkout_page.png");
            log("Checkout page loaded!");
        } else {
            log("Checkout button not found!");
        }
    }

    public void addAddress() {
        log("Navigating to profile to add address...");
        driver.get(baseUrl + "/profile");

        try {
            WebElement addLink = driver.findElement(By.xpath("//a[contains(text(),'Add New Address')]"));
            actions.moveToElement(addLink).click().perform();
            Thread.sleep(1000);
            log("'Add New Address' clicked!");

            driver.findElement(By.name("label")).sendKeys("Home");
            driver.findElement(By.name("line1")).sendKeys("123 Sample Street");
            driver.findElement(By.name("line2")).sendKeys("Unit 5B");
            driver.findElement(By.name("city")).sendKeys("Quezon City");
            driver.findElement(By.name("region")).sendKeys("NCR");
            driver.findElement(By.name("postal_code")).sendKeys("1100");
            driver.findElement(By.name("country")).sendKeys("Philippines");

            WebElement saveBtn = driver.findElement(By.xpath("//button[contains(text(),'Save Address')]"));
            actions.moveToElement(saveBtn).click().perform();
            Thread.sleep(2000);
            log("Address saved successfully!");
        } catch (NoSuchElementException e) {
            log("Address already exists or skipped.");
        } catch (InterruptedException ignored) {}
    }

    public void fillCheckoutDetails(String fullName, String phone) {
        driver.findElement(By.name("full_name")).clear();
        driver.findElement(By.name("full_name")).sendKeys(fullName);
        driver.findElement(By.name("phone")).clear();
        driver.findElement(By.name("phone")).sendKeys(phone);

        try {
            WebElement addressRadio = driver.findElement(By.name("address_id"));
            if (!addressRadio.isSelected()) addressRadio.click();

            WebElement cod = driver.findElement(By.cssSelector("input[name='payment_method'][value='cash_on_delivery']"));
            if (!cod.isSelected()) cod.click();
        } catch (NoSuchElementException ignored) {}

        log("Checkout details filled!");
    }

    public void placeOrder() {
        try {
            WebElement placeOrderBtn = wait.until(ExpectedConditions.elementToBeClickable(
                    By.xpath("//button[contains(text(),'Place Order')]")
            ));
            placeOrderBtn.click();
            Thread.sleep(2000);
            log("Order placed successfully!");
        } catch (Exception e) {
            log("Failed to place order: " + e.getMessage());
        }
    }

    public void viewOrderHistoryLink() {
        try {
            WebElement viewOrders = wait.until(ExpectedConditions.elementToBeClickable(
                    By.xpath("//a[contains(text(),'View Order History')]")
            ));
            viewOrders.click();
            wait.until(ExpectedConditions.presenceOfAllElementsLocatedBy(By.cssSelector("div.order-card")));
            log("Navigated to order history page!");
        } catch (Exception e) {
            log("'View Order History' link not found: " + e.getMessage());
        }
    }

    // ---------------- Full Flow ----------------
    public void runFullEcommerceFlow(String fullName, String email, String password, String phone) {
        login(email, password);
        addProductsToCart(1);
        goToCart();
        proceedToCheckout();
        addAddress();
        goToCart();
        proceedToCheckout();
        fillCheckoutDetails(fullName, phone);
        placeOrder();
        viewOrderHistoryLink();
        log("E-commerce automation flow completed successfully!");
    }

    // ---------------- Utilities ----------------
    public void close() {
        if (driver != null) driver.quit();
    }

    public void takeScreenshot(String filename) {
        try {
            File screenshot = ((TakesScreenshot) driver).getScreenshotAs(OutputType.FILE);
            File target = Paths.get(filename).toFile();
            org.openqa.selenium.io.FileHandler.copy(screenshot, target);
        } catch (IOException e) {
            log("Failed to take screenshot: " + filename);
        }
    }
}
