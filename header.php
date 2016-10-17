<?php
/**
 * The template for displaying the header
 * Displays all of the head element and header.
 */
?>
  <!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" prefix="og: http://ogp.me/ns#">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if (is_singular() && pings_open(get_queried_object())) : ?>
      <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php endif; ?>
    <title><?php if (!is_front_page()) {
        wp_title('');
        echo " | ";
      }
      bloginfo('name');
      ?></title>
    <meta property="og:title" content="<?php wp_title('') ?>"/>
    <meta property="og:image"
          content="<?php echo TemplateFunctions::getFeaturedImage(get_the_ID(), 'full')[0] ?>"/>
    <meta property="og:url" content="<?php the_permalink() ?>"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php the_permalink() ?>">
    <meta name="twitter:site" content="<?php the_field('twitter_hashtag', 'options'); ?>">
    <meta name="twitter:title" content="<?php wp_title('') ?>">
    <meta name="twitter:image:src"
          content="<?php echo TemplateFunctions::getFeaturedImage(get_the_ID(), 'full')[0] ?>"/>
    <meta name="twitter:creator" content="<?php the_field('twitter_user', 'options'); ?>">
    <?php do_action('header_scripts') ?>
    <?php wp_head(); ?>
    <style>
      <?php require_once ('css/loader.css')?>
    </style>
  </head>
<body <?php body_class(); ?>>
<?php
do_action('tracking_scripts');
do_action('loader_section');
?>