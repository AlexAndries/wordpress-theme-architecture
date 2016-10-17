<?php

/**
 * Created by PhpStorm.
 * User: Alex Andries
 * Date: 10/18/2015
 * Time: 1:55 AM
 */
class TemplateFunctions{
  
  /**
   * Return Logo
   *
   * @return string
   */
  public static function getHeaderLogo(){
    $logo = get_field('logo', 'options');
    $content = '
            <a href="' . home_url() . '" title="' . get_bloginfo('name') . '">
                <img src="' . $logo['sizes']['large'] . '" width="' . $logo['sizes']['large-width'] . '" height="' . $logo['sizes']['large-height'] . '" alt="' . $logo['title'] . '"/>
            </a>
        ';
    
    return $content;
  }
  
  public static function getHeaderLogoNoHref($class = null){
    $logo = get_field('logo', 'options');
    $content = '
        <img src="' . $logo['sizes']['large'] . '" class="' . $class . '" width="' . $logo['sizes']['large-width'] . '" height="' . $logo['sizes']['large-height'] . '" alt="' . $logo['title'] . '"/>
        ';
    
    return $content;
  }
  
  /**
   * Print Copyright
   */
  public static function showCopyright(){
    echo '<div class="copyright">' . get_field('copyright_text', 'options') . '</div>';
  }
  
  /**
   * Seo Alt tag for images
   *
   * @param $string
   *
   * @return string
   */
  public static function create_SEO_alt($string){
    $strings = str_split($string);
    $alt = "";
    $up = true;
    $first = true;
    foreach ($strings as $e) {
      if (preg_match('/[^a-zA-Z]/', $e)) {
        $alt .= "";
        $up = true;
      } else {
        if ($up) {
          if ($first) {
            $first = false;
            $alt .= strtoupper($e);
          } else {
            $alt .= ' ' . strtoupper($e);
          }
          $up = false;
        } else {
          $alt .= $e;
        }
      }
    }
    
    return $alt;
  }
  
  /**
   * Print Social Media
   *
   * @param string $ulClass
   * @param string $liClass
   * @param string $aClass
   *
   * @return bool
   */
  static public function showSocial($ulClass = 'list-unstyled', $liClass = 'each-social', $aClass = ""){
    $social = get_field('follow_us', 'options');
    if (!empty($social)) {
      $content = '<ul class="' . $ulClass . '">';
      foreach ($social as $item) {
        $content .= '<li class="' . $liClass . '" data-name="' . str_replace('fa-', '', $item['icon']) . '">
                    <a href="' . $item['url'] . '" target="_blank" rel="nofollow" class="' . $aClass . '"><i 
				class="fa ' . $item['icon'] . '"></i>' . $item['title'] . '</a>
                </li>';
      }
      $content .= '</ul>';
      echo $content;
    } else {
      return false;
    }
    
    return true;
  }
  
  /**
   * @param        $post_id
   * @param string $size
   *
   * @return mixed
   */
  public static function getFeaturedImage($post_id, $size = 'medium'){
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size);
    
    return $image;
  }
  
  public static function getPageUrl($slug){
    return get_permalink(get_page_by_path($slug));
  }
  
  public static function addThemeSupport($item){
    add_theme_support($item);
  }
  
  public static function ajaxSecurity($front = false){
    if ($front) {
      if (strpos($_SERVER['HTTP_REFERER'], home_url()) != 0) {
        self::printResult(array(
          'error'   => true,
          'message' => 'Access Denied!'
        ));
      }
    }
    if (strpos($_SERVER['HTTP_REFERER'], home_url() . '/wp-admin/') != 0) {
      self::printResult(array(
        'error'   => true,
        'message' => 'Access Denied!'
      ));
    }
  }
  
  public static function printResult($array, $return = false){
    if ($return) {
      return $array;
    }
    print_r(json_encode($array));
    
    wp_die();
  }
  
  public static function getRequest(){
    $request = fopen("php://input", "r");
    $putData = '';
    while ($data = fread($request, 1024)) {
      $putData .= $data;
    }
    
    fclose($request);
    
    return json_decode($putData);
  }
}