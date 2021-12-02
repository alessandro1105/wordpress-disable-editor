<?php
/**
 * Plugin Name:  Dartmoon disable editor 
 * Plugin URI:   https://dartmoon.io
 * Description:  Disable editor for specific templates, pages, posts, etc.
 * Version:      1.0.1
 * Author:       Dartmoon
 * Author URI:   https://dartmoon.io
 * License:      PROPRIETARY
 */

/**
 * Disable Gutemberg editor
 */
function drtn_disable_gutemberg($can_edit, $post_type) {
    // If we are not on the admin interface
    // or there is no ID int the get parameters
    // we canno do anithing
	if (!is_admin()) {
        return $can_edit;
    }

    // Let the template decide whether 
    // to show the template
    $post_id = (int) ($_GET['post'] ?? 0);
    $post_type = $_GET['post_type'] ?? get_post_type($post_id);
    $can_edit = apply_filters('drtn/disable_gutemberg', $can_edit, $post_id, $post_type);

	return $can_edit;
}
add_filter('gutenberg_can_edit_post_type', 'drtn_disable_gutemberg', 10, 2);
add_filter('use_block_editor_for_post_type', 'drtn_disable_gutemberg', 10, 2);

/**
 * Disable Classic Editor by template
 *
 */
function drtn_disable_classic_editor() {
    // If we are not on the admin interface
    // or there is no ID int the get parameters
    // we canno do anithing
	if (!is_admin()) {
        return;
    }

    // Let the template decide whether 
    // to show the template
    $post_id = (int) ($_GET['post'] ?? 0);
    $post_type = $_GET['post_type'] ?? get_post_type($post_id);
    $can_edit = apply_filters('drtn/disable_editor', post_type_supports('page', 'editor'), $post_id, $post_type);
    
    // If the user do not want the editor let's remove it
	if (!$can_edit) {
		remove_post_type_support($post_type, 'editor');
	}
}
add_action('admin_head', 'drtn_disable_classic_editor');
