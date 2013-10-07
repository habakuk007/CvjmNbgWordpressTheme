<?php
/* Place all needed callback functions here
 */

function register_my_menus() {

  register_nav_menu('header-menu',__( 'Header Menu' ));
  register_nav_menu('footer-menu', __( 'Footer Menu' ));

}

add_action ('init', 'register_my_menus');

/**********************
 * Walker function for footer menu
 **********************/
class Footer_Menu_Walker extends Walker_Nav_Menu {
  // Each item get's the class footer_menu_item_depth_x
  function start_el(&$output, $item, $depth=0, $args=array()) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    $classes[] = 'footer_menu_item_depth_' . $depth;

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}

/**********************
 * Stylesheet stuff
 **********************/
function register_my_stylesheets() {
  $version = '0.1';
  wp_register_style('common-style', get_template_directory_uri() . '/style.css', array(), $version, 'all');
  wp_register_style('frontpage-style', get_template_directory_uri() . '/css/frontpage_style.css', array(), $version, 'all');
  wp_register_style('target-group-style', get_template_directory_uri() . '/css/target_group_style.css', array(), $version, 'all');
}

function add_needed_stylesheets() {
  wp_enqueue_style( 'common-style');
  /* index.php gets frontpage css */
  if ( is_home() )
  {
    wp_enqueue_style( 'frontpage-style');
  } else if ( is_page_template( 'target_group.php') ) {
    wp_enqueue_style( 'target-group-style');
  }
}

function safely_add_stylesheet() {
  register_my_stylesheets();
  add_needed_stylesheets();
}

add_action( 'wp_enqueue_scripts', 'safely_add_stylesheet' );
?>
