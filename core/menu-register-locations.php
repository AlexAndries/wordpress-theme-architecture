<?php

/**
 * Created by PhpStorm.
 * User: Alex Andries
 * Date: 10/17/2015
 * Time: 11:45 PM
 */
class MenuLocations{
  public $menus = array();
  
  /**
   * @param array $array
   */
  public function __construct($array = array()){
    if (!empty($array)) {
      $this->menus = $array;
    }
  }
  
  /**
   * @param array $array
   *
   * @return $this
   */
  public function addMenu($array = array()){
    $this->menus = array_merge($this->menus, $array);
    
    return $this;
  }
  
  /**
   * @param $id
   *
   * @return $this
   */
  public function removeMenu($id){
    unset($this->menus[$id]);
    
    return $this;
  }
  
  /**
   * Register Menus
   */
  public function registerMenus(){
    register_nav_menus($this->menus);
  }
}