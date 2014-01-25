<?php
/* Place all needed callback functions here
 */

function register_my_menus() {

  // Main menus
  register_nav_menu('top-short-menu',__('Top Short Menu'));
  register_nav_menu('header-menu',__( 'Header Menu' ));
  register_nav_menu('footer-menu', __( 'Footer Menu' ));

  // Association menus
  register_nav_menu('eibach-menu', __( 'Eibach Menu' ));
  register_nav_menu('gostenhof-menu', __( 'Gostenhof Menu' ));
  register_nav_menu('grossgruendlach-menu', __( 'Großgründlach Menu' ));
  register_nav_menu('kornmarkt-menu', __( 'Kornmarkt Menu' ));
  register_nav_menu('lichtenhof-menu', __( 'Lichtenhof Menu' ));
  register_nav_menu('schwaig-menu', __( 'Schwaig Menu' ));
}

function adjust_roles() {
  $roleObject = get_role( 'editor' );
  if (!$roleObject->has_cap( 'edit_theme_options' ) ) {
      $roleObject->add_cap( 'edit_theme_options' );
  }
}

function add_my_query_args() { 
    global $wp; 
    $wp->add_query_var('evterm_hilight'); 
	$wp->add_query_var('evterm_pageid'); 
}

add_action ('init', 'register_my_menus');
add_action ('init', 'adjust_roles');
add_action('init','add_my_query_args');

function hide_menu() {
    remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
    remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
	remove_submenu_page( 'themes.php', 'customize.php' ); // hide the customize submenu
}

add_action('admin_head', 'hide_menu');

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

function menu_has_next($sorted_menu_items, $args) {
    $parents = array();

	end($sorted_menu_items)->is_last = true;

    return $sorted_menu_items;
}

add_filter('wp_nav_menu_objects', 'menu_has_next', 10, 2);

/**********************
 * Walker function for top menu
 **********************/
class Top_Menu_Walker extends Walker_Nav_Menu {
  /**
   * @see Walker::start_lvl()
   * @since 3.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int $depth Depth of page. Used for padding.
   */
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    return;
  }
  
  /**
  * Ends the list of after the elements are added.
  *
  * @see Walker::end_lvl()
  *
  * @since 3.0.0
  *
  * @param string $output Passed by reference. Used to append additional content.
  * @param int    $depth  Depth of menu item. Used for padding.
  * @param array  $args   An array of arguments. @see wp_nav_menu()
  */
  function end_lvl( &$output, $depth = 0, $args = array() ) {
    return;
  }
  
  function start_el(&$output, $item, $depth=0, $args=array()) {
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    // We want normal text for the link
    $attributes .= ' class="clearlink"';
	
    $item_output = '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</a>';
	if (!isset($item->is_last))
	{
	  $item_output .= '&nbsp;|&nbsp;';
	}
	
	$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
  
  /*
  function start_el(&$output, $item, $depth=0, $args=array()) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    $classes[] = 'linelist';

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    // We want normal text for the link
    $attributes .= ' class="clearlink"';

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</a>';
	if (!isset($item->is_last))
	{
	  $item_output .= '&nbsp;|&nbsp;';
	}
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
  */
  
  /**
   * @see Walker::end_el()
   * @since 3.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $item Page data object. Not used.
   * @param int $depth Depth of page. Not Used.
   */
  function end_el( &$output, $item, $depth = 0, $args = array() ) {

  }
}

/**********************
 * Walker function for header menu with popup menus
 **********************/
class Walker_Header_Popup_Menu extends Walker_Nav_Menu {
  /**
   * @see Walker::start_lvl()
   * @since 3.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param int $depth Depth of page. Used for padding.
   */
  function start_lvl( &$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"header-sub-menu-popup\">\n";
  }

  /**
   * @see Walker::start_el()
   * @since 3.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $item Menu item data object.
   * @param int $depth Depth of menu item. Used for padding.
   * @param int $current_page Menu item ID.
   * @param object $args
   */
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    if ($depth==0)
    {
      $classes[] = 'linelist';
    }

    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
    $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

    $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    if ($depth==0)
    {
	  // We want normal text for the link
      $attributes .= ' class="clearlink"';
	} else {
      // We want normal text for the link
      $attributes .= ' class="whitelink"';
	}

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
    $item_output .= '</a>';
    if ($args->has_children && $depth==0)
    {
      $item_output .= '<a href="#"><img src="' . get_bloginfo('template_directory') . '/images/arrow_down.png" class="header_menu_arrow" /></a>';
    }
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

  /**
   * Traverse elements to create list from elements.
   *
   * Display one element if the element doesn't have any children otherwise,
   * display the element and its children. Will only traverse up to the max
   * depth and no ignore elements under that depth. It is possible to set the
   * max depth to include all depths, see walk() method.
   *
   * This method shouldn't be called directly, use the walk() method instead.
   *
   * @since 2.5.0
   *
   * @param object $element Data object
   * @param array $children_elements List of elements to continue traversing.
   * @param int $max_depth Max depth to traverse.
   * @param int $depth Depth of current element.
   * @param array $args
   * @param string $output Passed by reference. Used to append additional content.
   * @return null Null on failure with no changes to parameters.
   */
  function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
    $id_field = $this->db_fields['id'];
    // Check if the element has subitems and remember this in our arg array
    // as 'has_children' element.
    if ( is_object( $args[0] ) ) {
      $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
    }
    return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
  }

  /**
   * @see Walker::end_el()
   * @since 3.0.0
   *
   * @param string $output Passed by reference. Used to append additional content.
   * @param object $item Page data object. Not used.
   * @param int $depth Depth of page. Not Used.
   */
  function end_el( &$output, $item, $depth = 0, $args = array() ) {
    $output .= "</li>\n";
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
  wp_register_style('association', get_template_directory_uri() . '/css/association.css', array(), $version, 'all');
}

function add_needed_stylesheets() {
  wp_enqueue_style( 'common-style');
  /* index.php gets frontpage css */
  if ( is_home() )
  {
    wp_enqueue_style( 'frontpage-style');
  }
  if ( is_page_template( 'target_group.php') ) {
    wp_enqueue_style( 'target-group-style');
  }
  if ( is_page_template( 'association.php' ) || is_page_template( 'association_freepage.php' ) ) {
    wp_enqueue_style( 'association');
  }
}

function safely_add_stylesheet() {
  register_my_stylesheets();
  add_needed_stylesheets();
}

add_action( 'wp_enqueue_scripts', 'safely_add_stylesheet' );

// Additional shortcuts for content editing
// [evtermine] Shortcut
function evtermine_func( $atts ) {
  extract( shortcode_atts( array(
    'count' => null,
    'vid' => null,
    'query' => null
  ), $atts ) );
  ob_start();
  $event_count = $count;
  $event_vid = $vid;
  $event_add_query = $query;
  require locate_template('event-box.php');
  $ev_output = ob_get_clean();

  return $ev_output;
}

add_shortcode( 'evtermine', 'evtermine_func' );

// Ajax handling functions
// Reload ev Termine through ajax call
function evtermine_ajax( ) {

  header( "Content-Type: text/plain" );

  ob_start();
  if (array_key_exists('count', $_POST)) {
    $event_count = $_POST['count'];
  }
  if (array_key_exists('vid', $_POST)) {
    $event_vid = $_POST['vid'];
  }
  if (array_key_exists('query', $_POST)) {
    $event_add_query = $_POST['query'];
  }
  if (array_key_exists('filter', $_POST)) {
    $event_show_filter = $_POST['filter'];
  }
  require locate_template('event-box.php');
  $ev_output = ob_get_clean();

  echo $ev_output;

  exit;
}

add_action( 'wp_ajax_nopriv_evtermine-ajax', 'evtermine_ajax' );
add_action( 'wp_ajax_evtermine-ajax', 'evtermine_ajax' );