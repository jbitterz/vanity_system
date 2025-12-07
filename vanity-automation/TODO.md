# Vanity Automation Setup - TODO

## ✅ Completed Tasks

- [x] Updated pom.xml to use Playwright instead of Selenium
- [x] Created EcommerceAutomation.java with all automation methods
- [x] Created EcommerceAutomationTest.java for JUnit tests
- [x] Created VanityAutomation.java main class for direct execution
- [x] Updated README.md with setup and usage instructions
- [x] Updated configuration in VanityAutomation.java with appropriate defaults

## 🔧 Setup Tasks (You need to do these)

- [ ] Install Playwright browsers: `mvn exec:java -Dexec.mainClass=com.microsoft.playwright.CLI -Dexec.args="install"`
- [ ] Update configuration in VanityAutomation.java:
  - Change BASE_URL to your Laravel app URL (currently "http://localhost:8000")
  - Update USER_EMAIL and USER_PASSWORD for a valid test user
  - Update contact details if needed
- [ ] Ensure your Laravel application is running
- [ ] Ensure test user exists and has at least one saved address
- [ ] Ensure products are seeded in the database

## 🚀 Running the Automation

Once setup is complete, run:
```bash
cd vanity-automation
mvn clean compile exec:java -Dexec.mainClass="com.vanity.automation.VanityAutomation"
```

Or run tests:
```bash
mvn test
```

## 📝 Notes

- The automation runs in non-headless mode with 1-second delays for visibility
- If you want headless mode, edit EcommerceAutomation.java constructor
- Screenshots can be taken for debugging using takeScreenshot() method
- All selectors are designed to be flexible and handle variations in the HTML structure
