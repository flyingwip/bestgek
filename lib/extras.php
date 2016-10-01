<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Plugin Name: Add Advance Custom Fields to JSON API
 * Description: Add Advance Custom Fields to JSON API - from https://gist.github.com/rileypaulsen/9b4505cdd0ac88d5ef51
 * Author: @PanMan
 * Author URI: https://github.com/PanManAms/WP-JSON-API-ACF
 * Version: 0.1
 * Plugin URI: https://github.com/PanManAms/WP-JSON-API-ACF
 * Copied from https://gist.github.com/rileypaulsen/9b4505cdd0ac88d5ef51 - but a plugin is nicer
 */
