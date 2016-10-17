<?php
/**
 * Created by PhpStorm.
 * User: Alex Andries
 * Date: 6/17/2016
 * Time: 10:04 AM
 */
/**
 * Remove Query String from Static Resources
 */
function remove_cssjs_ver($src){
  if (strpos($src, '?ver=')) {
    $src = remove_query_arg('ver', $src);
  }
  
  return $src;
}

add_filter('style_loader_src', 'remove_cssjs_ver', 10, 2);
add_filter('script_loader_src', 'remove_cssjs_ver', 10, 2);

add_action('wp_head', 'general_javascript_variables', 1);
function general_javascript_variables(){
  ?>
  <script>
    var site_url = "<?php echo home_url(); ?>",
      ajax_url = "<?php echo admin_url('admin-ajax.php'); ?>",
      sliders = [],
      config = {
        FID: "<?php the_field('facebook_app_id', 'options') ?>"
      },
      dataLayer = [];
  </script>
  <?php
}

add_action('absolute-position-social-media', 'socialMediaBlock');

function socialMediaBlock(){
  $socialMedia = get_field('follow_us', 'options');
  if (!empty($socialMedia)) {
    ?>
    <div class="social-media-block">
      <ul class="list-unstyled">
        <?php foreach ($socialMedia as $item) { ?>
          <li class="<?php echo str_replace('fa-', '', $item['icon']); ?>">
            <a target="_blank" href="<?php echo $item['url'] ?>" title="Follow Us">
              <i class="fa <?php echo $item['icon']; ?>"></i>
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
    <?php
  }
}

add_action('loader_section', 'loaderSiteBlock');
function loaderSiteBlock(){
  global $cookiesDB;
  $currentUserDeploy = $cookiesDB->getCookie('loading');
  if (!$currentUserDeploy || $currentUserDeploy < DEPLOY_COUNT) {
    $logoFade = get_field('loader_fade_image', 'options');
    $logo = get_field('loader_complete_image', 'options') ?>
    <div class="loading-wrapper" style="background-color:<?php the_field('loader_background', 'options') ?>">
      <div class="loading-content">
        <img src="<?php echo $logoFade['url'] ?>" height="<?php echo $logoFade['height'] ?>"
             width="<?php echo $logoFade['width'] ?>" class="img-responsive"
             alt="<?php bloginfo('name') ?>">
        <div class="loader-effect">
          <img src="<?php echo $logo['url'] ?>" height="<?php echo $logo['height'] ?>"
               width="<?php echo $logo['width'] ?>" class="img-responsive"
               alt="<?php bloginfo('name') ?>">
        </div>
      </div>
    </div>
    <?php
  }
}

add_action('tracking_scripts', 'tracking_scripts');
function tracking_scripts(){
  the_field('ga_code', 'options');
  the_field('pixel_code', 'options');
}

function disable_embeds_init(){
  remove_action('rest_api_init', 'wp_oembed_register_route');
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  remove_action('wp_head', 'wp_oembed_add_host_js');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  
  // filter to remove TinyMCE emojis
  add_filter('tiny_mce_plugins', 'disable_emojicons_tinymce');
}

add_action('init', 'disable_embeds_init', 9999);

function disable_emojicons_tinymce($plugins){
  if (is_array($plugins)) {
    return array_diff($plugins, array('wpemoji'));
  }
  
  return array();
  
}