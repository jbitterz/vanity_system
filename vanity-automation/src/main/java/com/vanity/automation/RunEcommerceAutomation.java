package com.vanity.automation;

public class RunEcommerceAutomation {
    public static void main(String[] args) {
        // Base URL of your Laravel app
        String baseUrl = "http://localhost:8000";

        EcommerceAutomation automation = new EcommerceAutomation(baseUrl);

        try {
            // Test user details
            String fullName = "Juliana Validor";
            String email = "test" + System.currentTimeMillis() + "@example.com";
            String password = "Chenchen1234!";
            String phone = "09123456789";

            // Register user (skips if already exists)
            automation.registerUser(fullName, email, password);

            // Run full e-commerce flow including adding address, checkout, placing order, and viewing order history
            automation.runFullEcommerceFlow(fullName, email, password, phone);

        } finally {
            // Close browser and Playwright
            automation.close();
        }
    }
}
