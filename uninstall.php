<?php
/**
 * @package Lang-changer
 */

if( ! defined('WP_UNINSTALL_PLUGIN'))
{
    die;
}

$translates = get_posts(array( 'post_type' =>'translate','numberposts' => -1));

// foreach ($translates as $translate)
// {
//     wp_delete_post ($book->ID, true);
// }

global $wpdb;

$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'translate'");
$wpdb->query( "DELETE FROM wp_postsmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");