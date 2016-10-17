<?php

/**
 * Created by Alex A.
 * Project: angular-wp
 * Date: 22/12/2015
 * Time: 05:23 PM
 */
class CustomPermalinkTaxonomies{
  
  public $taxonomy;
  
  public $postType;
  
  public $taxonomies = array();
  
  public function __construct($taxonomy, $postType){
    $this->taxonomy = $taxonomy;
    $this->postType = $postType;
    $this->buildRewrite();
    add_filter('term_link', array(
      $this,
      'custom_taxonomyBase_link'
    ), 10, 3);
  }
  
  public function buildRewrite(){
    $this->getAllSlugs();
    if (!empty($this->taxonomies)) {
      foreach ($this->taxonomies as $tax) {
        add_rewrite_rule($this->postType . '/' . $tax . '/?$',
          'index.php?post_type=' . $this->postType . '&' . $this->taxonomy . '=' . $tax . '', 'top');
        add_rewrite_rule($this->postType . '/' . $tax . '/page/([0-9]+)/?',
          'index.php?post_type=' . $this->postType . '&' . $this->taxonomy . '=' . $tax . '&paged=$matches[1]', 'top');
      }
    }
  }
  
  public function getAllSlugs(){
    $taxonomies = array('categories');
    
    $args = array(
      'orderby'    => 'name',
      'order'      => 'ASC',
      'hide_empty' => false
    );
    $categories = get_terms($taxonomies, $args);
    if (!empty($categories) && !@$categories['errors']) {
      foreach ($categories as $tax) {
        $this->taxonomies[] = $tax->slug;
      }
    }
  }
  
  public function custom_taxonomyBase_link($link, $term, $taxonomy){
    if ($taxonomy !== $this->taxonomies)
      return $link;
    
    return str_replace($this->taxonomies . '/', '', $link);
  }
  
}