<?php
/**
 * Created by Alex A.
 * Project: theme-dev
 * Date: 24/11/2015
 * Time: 05:21 PM
 */
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'page_title' => 'Theme Settings',
    'menu_title' => 'Theme Settings',
    'menu_slug'  => 'theme-general-settings',
    'capability' => 'edit_posts',
    'redirect'   => false,
    'position'   => 3
  ));
}
