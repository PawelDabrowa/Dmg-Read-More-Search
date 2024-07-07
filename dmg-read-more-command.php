<?php
/**
 * Plugin Name: Dmg Read More Search
 * Description: Search for posts containing the Gutenberg "Read More" block within a date range using WP-CLI.
 * Version:     0.1.0
 * Author:      Pawel Dabrowa
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Search for posts containing the Gutenberg "Read More" block within a date range using WP-CLI.
 *
 * @param array $args Positional arguments.
 * @param array $assoc_args Associative arguments.
 */
function dmg_read_more_search( $args, $assoc_args ) {
    global $wpdb;
    
    // Default 7 days if not provided
    $date_after = isset( $assoc_args['date-after'] ) ? $assoc_args['date-after'] : date( 'Y-m-d', strtotime( '-7 days' ) );
    $date_before = isset( $assoc_args['date-before'] ) ? $assoc_args['date-before'] : date( 'Y-m-d' );

    $query = $wpdb->prepare(
        "
        SELECT ID 
        FROM {$wpdb->posts}
        WHERE post_type = 'post'
        AND post_status = 'publish'
        AND post_date BETWEEN %s AND %s
        AND post_content LIKE %s
        ",
        $date_after . ' 00:00:00', $date_before . ' 23:59:59', '%<!-- wp:more -->%'
    );

    $post_ids = $wpdb->get_col( $query );

    if ( ! empty( $post_ids ) ) {
        foreach ( $post_ids as $post_id ) {
            WP_CLI::log( $post_id );
        }
    } else {
        WP_CLI::log( 'No posts found containing the "Read More" block within the specified date range.' );
    }
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
    WP_CLI::add_command( 'dmg-read-more search', 'dmg_read_more_search' );
}

function dmg_read_more_search_activate() {
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'dmg_read_more_search_activate' );

function dmg_read_more_search_deactivate() {
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'dmg_read_more_search_deactivate' );
?>
