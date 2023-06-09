Feature: Home Page

  Ensure the home page content is available

  Scenario: View the homepage content
    Given I am on the homepage
    Then the response status code should be 200
    And I should see "About"
    And I should see "Services"
    And I should see "Publications"
    And I should see "News & Media"
    And I should see "Resources"
    And I should see "Contact"
    And I should see "About Us"
    And I should see "Latest updates"
    And I should see "View more updates"
    And I should see "Quick Links"
