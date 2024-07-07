# Dmg Read More Search

## Description

Dmg Read More Search is a WordPress plugin that allows administrators to search for posts containing the Gutenberg "Read More" block within a specified date range using WP-CLI. This plugin is optimized for performance, making it suitable for large WordPress sites with millions of posts.

## Features

- Search for posts containing the Gutenberg "Read More" block.
- Specify date range for the search.
- Efficient and performant, handling large datasets with ease.
- Outputs post IDs of matching posts via WP-CLI.

## Installation

1. **Download the Plugin**: Clone or download the plugin from the repository.

   ```bash
   git clone https://github.com/paweldabrowa/dmg-read-more-search.git
Upload to WordPress: Upload the dmg-read-more-search directory to your WordPress site's wp-content/plugins directory.

Activate the Plugin: Go to the WordPress admin dashboard, navigate to Plugins, and activate the "Dmg Read More Search" plugin.

Usage
WP-CLI Command
The plugin's functionality is accessed via a WP-CLI command. Ensure you have WP-CLI installed and configured on your server.

Command Syntax:

bash
Copy code
wp dmg-read-more search [--date-after=<date>] [--date-before=<date>]
Arguments:

--date-after: (Optional) The start date for the search range in YYYY-MM-DD format. Defaults to 7 days before the current date if not provided.
--date-before: (Optional) The end date for the search range in YYYY-MM-DD format. Defaults to the current date if not provided.
Example:

bash
Copy code
wp dmg-read-more search --date-after=2023-01-01 --date-before=2023-01-31
This command searches for posts published between January 1, 2023, and January 31, 2023, that contain the "Read More" block.
