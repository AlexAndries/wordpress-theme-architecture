<?php
/**
 * Created by PhpStorm.
 * User: Alex Andries
 * Date: 8/4/2016
 * Time: 4:41 PM
 *
 * @package WordPress
 * @subpackage Dev Theme
 * @since Custom Admin Theme 1.0
 *
 * @requirement leafo/scssphp to process sass style
 */
define('THEME_ADMIN_DIR', __DIR__ . '/');
define('THEME_ADMIN_URL', THEME_URL . 'includes/custom-admin-theme/');

require_once('classes/sass-compiler.php');
require_once('classes/custom-admin-core.php');

if(isset($_GET['compile'])){
	$scss = new SassCompiler();
	$scss->compile();
}
$core = new CustomAdminCore();