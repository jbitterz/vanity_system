package com.vanity.automation;

public class RunEcommerceAutomation {
    public static void main(String[] args) {
        String baseUrl = "http://localhost:8000"; // adjust if needed

        EcommerceAutomation automation = new EcommerceAutomation(baseUrl);

        try {
            String fullName = "Juliana Validor";
            String email = "test" + System.currentTimeMillis() + "@example.com";
            String password = "Chenchen1234!";
            String phone = "09123456789";

            // Register user (skip if exists)
            automation.registerUser(fullName, email, password);

            // Run the full e-commerce automation flow
            automation.runFullEcommerceFlow(fullName, email, password, phone);

        } finally {
            automation.close();
        }
    }
}
