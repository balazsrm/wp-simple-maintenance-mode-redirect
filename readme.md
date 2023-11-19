
# Maintenance Mode Plugin for WordPress

## Description
The Maintenance Mode Plugin for WordPress allows administrators to redirect all non-logged-in users to a specific page on the site. This is particularly useful for displaying a "maintenance" or "coming soon" page while updating or modifying the site. The plugin ensures that logged-in users, have full access to the site, including the admin area and the login page.

The plugin is designed to be lightweight and simple to use. It does not include any unnecessary features or settings. It is intended to be used as a temporary solution, or as a base for developers to build upon.

## Features
- **Redirect Non-Logged-In Users**: Automatically redirects visitors who are not logged in to a specified page.
- **Admin Settings Page**: A settings page in the WordPress admin area to select the redirection page.
- **Admin Bar Notification**: Displays a warning in the WordPress admin bar when the redirection is active.
- **Exclusion of Admin and Login Pages**: Ensures that requests to `wp-admin` and `wp-login.php` are not redirected.

## Installation
1. Download the plugin file.
2. Upload it to your WordPress plugins directory.
3. Navigate to the WordPress admin area and activate the plugin through the 'Plugins' menu.

## Usage
After activation, go to the settings page under 'Settings > Maintenance Mode' in the WordPress admin area. Select the page to which non-logged-in users should be redirected. If no page is selected, redirection will not occur.

## About
This plugin was created using the WP Plugin Architect GPT. For more information, visit: [WP Plugin Architect GPT](https://chat.openai.com/g/g-6cqBCrKTn-wp-plugin-architect)

## License
This plugin is open source and licensed under the GPL v2 or later.