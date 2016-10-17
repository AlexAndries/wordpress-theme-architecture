<?php
/**
 * Define Deploy constant
 */
define('DEPLOY_COUNT', 1);

/**
 * load Vendor if they exists
 */
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
  require_once('vendor/autoload.php');
}

/**
 * load Core
 */
require_once('core/init-core.php');

/**
 * Load Api
 */
require_once('api/load-api.php');

/**
 * Load Custom Admin Theme
 */
require_once('includes/custom-admin-theme/custom-admin-theme.php');

/**
 * load Packages
 */
require_once('package/load-packages.php');

/**
 * Hide menu elements admin
 */
$adminMenu = new MenusAdminWrapper();
$adminMenu->addSubMenuToHide('themes.php', 'theme-editor.php')
          ->addSubMenuToHide('plugins.php', 'plugin-editor.php')
          ->addMenuToHide('edit-comments.php')
          ->addMenuToHide('edit.php');

/**
 * Register Menus
 */

$menus = new MenuLocations();
$menus->addMenu(array('primary-menu' => 'Main Menu'))
      ->addMenu(array('footer-menu' => 'Footer Menu'))
      ->registerMenus();

/**
 * Load Scripts
 */
$footerScripts = new EnqueueScripts(true);
$footerScripts->addStyle('bootstrap', THEME_URL_BOWER . 'bootstrap/dist/css/bootstrap.min.css')
              ->addStyle('font-awesome', THEME_URL_BOWER . 'components-font-awesome/css/font-awesome.min.css')
              ->addStyle('owl.carousel', THEME_URL_BOWER . 'owl.carousel/dist/assets/owl.carousel.min.css')
              ->addScript('jquery', THEME_URL_BOWER . 'jquery/dist/jquery.min.js')
              ->addScript('owl.carousel', THEME_URL_BOWER . 'owl.carousel/dist/owl.carousel.min.js')
              ->addScript('loader', THEME_URL . 'js/loader.js');

/**
 * Theme Support
 */
TemplateFunctions::addThemeSupport('post-thumbnails');

/**
 * Post Types
 */
