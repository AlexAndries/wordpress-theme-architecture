<?php
/**
 * Load Core files
 *
 * @package WordPress
 */

define('THEME_URL', get_bloginfo('stylesheet_directory') . '/');
define('THEME_URL_BOWER', THEME_URL . 'bower_components/');

/**
 * Template Functions Include
 */
require_once('template-functions.php');

/**
 * Include custom post types
 */
require_once('custom-post-type.php');

/**
 * Include menu register locations
 */
require_once('menu-register-locations.php');

/**
 * Include scripts and styles
 */
require_once('enqueue-scripts.php');

/**
 * Include Actions
 */

require_once('actions-set.php');

/**
 * Include CookieAPI
 */
require_once('cookies-db.php');

/**
 * Load Option pages
 */
require_once('option-page.php');

/**
 * Load Admin menu wrapper
 */
require_once('menu-admin-wrapper.php');