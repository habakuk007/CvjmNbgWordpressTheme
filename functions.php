<?php
/* Place all needed callback functions here
 */

function register_my_menus() {

  register_nav_menu('header-menu',__( 'Header Menu' ));
  register_nav_menu('footer-menu', __( 'Footer Menu' ));

}

add_action ('init', 'register_my_menus');

/**********************
 * Stylesheet stuff
 **********************/
function register_my_stylesheets() {
  $version = '0.1';
  wp_register_style('common-style', get_template_directory_uri() . '/style.css', array(), $version, 'all');
  wp_register_style('frontpage-style', get_template_directory_uri() . '/frontpage-style.css', array(), $version, 'all');
}

function add_needed_stylesheets() {
  wp_enqueue_style( 'common-style');
  /* index.php gets frontpage css */
  if ( is_home() )
  {
    wp_enqueue_style( 'frontpage-style');
  }
}

function safely_add_stylesheet() {
  register_my_stylesheets();
  add_needed_stylesheets();
}

add_action( 'wp_enqueue_scripts', 'safely_add_stylesheet' );
?>
