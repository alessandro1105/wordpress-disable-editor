<?php
/**
 * Plugin Name:  Dartmoon WordPress Utils 
 * Plugin URI:   https://dartmoon.io
 * Description:  Some general functions for wordpress
 * Version:      1.0.1
 * Author:       Dartmoon
 * Author URI:   https://dartmoon.io
 * License:      MIT
 */

/**
 * Register the same callable for multiple filters
 */
function add_filters($tags, $callable, $priority = 10, $accepted_args = 1) {
    if (!is_array($tags)) {
        $tags = [$tags];
    }
    
    foreach ($tags as $tag) {
        add_filter($tag, $callable, $priority, $accepted_args);
    }
}