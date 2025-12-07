package com.vanity;

import com.microsoft.playwright.Playwright;

public class InstallBrowsers {
    public static void main(String[] args) {
        System.out.println("Installing Playwright browsers...");
        try {
            Playwright.create().close();
            System.out.println("✅ Playwright browsers installed successfully!");
        } catch (Exception e) {
            System.err.println("❌ Failed to install browsers: " + e.getMessage());
            e.printStackTrace();
        }
    }
}
