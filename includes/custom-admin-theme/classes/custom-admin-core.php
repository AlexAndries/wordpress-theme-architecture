<?php

/**
 * Created by PhpStorm.
 * User: Alex Andries
 * Date: 8/8/2016
 * Time: 6:21 PM
 */
class CustomAdminCore{
  
  const VERSION = '1.0';
  
  const THEME_COLOR = '#56a34c';
  
  public function __construct(){
    add_action('admin_enqueue_scripts', array($this, 'registerResourcesAdmin'));
    add_action('admin_enqueue_scripts', array($this, 'favicon'));
    add_action('login_enqueue_scripts', array($this, 'registerResourcesLogin'), 99);
    add_action('login_enqueue_scripts', array($this, 'favicon'), 99);
    add_filter('login_headerurl', array($this, 'loginLogoUrl'));
    add_filter('login_headertitle', array($this, 'loginTitle'));
    add_action('wp_head', array($this, 'favicon'), 99);
  }
  
  public function registerResourcesAdmin(){
    wp_enqueue_style('main-css-custom-admin', THEME_ADMIN_URL . 'css/main.css', false, '1.0.0');
    wp_enqueue_script('main-js-pace', THEME_ADMIN_URL . 'js/pace.min.js', true, '1.0.0');
    
    wp_enqueue_script('main-js-custom-admin', THEME_ADMIN_URL . 'js/custom-admin.js', true, '1.0.0');
  }
  
  public function registerResourcesLogin(){
    wp_enqueue_style('custom-login', THEME_ADMIN_URL . 'css/login.css', false, '1.0.0');
  }
  
  public function loginLogoUrl(){
    return home_url();
  }
  
  public function loginTitle(){
    return get_bloginfo('name');
  }
  
  public function favicon(){
    ?>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo THEME_URL ?>images/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo THEME_URL ?>images/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo THEME_URL ?>images/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo THEME_URL ?>images/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo THEME_URL ?>images/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo THEME_URL ?>images/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo THEME_URL ?>images/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo THEME_URL ?>images/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo THEME_URL ?>images/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo THEME_URL
    ?>images/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo THEME_URL ?>images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo THEME_URL ?>images/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo THEME_URL ?>images/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?php echo THEME_URL ?>images/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="<?php echo self::THEME_COLOR ?>">
    <meta name="msapplication-TileImage" content="<?php echo THEME_URL ?>images/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="<?php echo self::THEME_COLOR ?>">
    <?php
  }
}