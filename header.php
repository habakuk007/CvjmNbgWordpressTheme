<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/* We get all values for the standard things from the parent page, so we need the ID of it */
$parent_id = getAssociationParent();

?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php wp_head(); ?>

<script type="text/javascript" charset="utf-8">
(function($) {
    // Inside of this function, $() will work as an alias for jQuery()
    // and other libraries also using $ will not be accessible under this shortcut
  $(window).load(function() {
    $('.flexslider').flexslider({ directionNav: false });
  });
  
  $(document).ready(function() {
    $('#navtoggle').sidr({
      name: 'sidr', /* ID des DIV's, der die Navigation beinhaltet */
      side: 'left' /* Seite auf der Sidr geöffnet werden soll, mögliche Werte sind left oder right */
    });

    $(window).resize();
  });
})(jQuery);
</script>

</head>

<body <?php body_class(); ?>>

<div class="header">
  <a href="<?php echo home_url();?>"><img src="<?php 
    if (get_field('vh_logo', $parent_id)) {
	  echo get_field('vh_logo', $parent_id);
	} else {
	  echo bloginfo('template_directory');
      echo '/images/logo_main.png';
	}
?>" class="headlogo"/></a> 
  <div class="header_right_nav_container">
    <?php wp_nav_menu( array( 'theme_location' => 'top-short-menu',
                            'container_class' => 'header_top_menu',
                            'walker' => new Top_Menu_Walker() ));?>
    <div class="headerright searchform">
      <form role="search" method="get" id="searchform" action="/">
	  <input type="hidden" name="post_type" id="post_type" value="page" />
	  <input type="hidden" name="orderby" id="post_type" value="title" />
	  <input type="hidden" name="order" id="order" value="ASC" />
      <input type="text" placeholder="Suchen..." name="s" id="s" class="search_field"<?php 
	    if (array_key_exists('s', $_GET)) {
          echo 'value="' . $_GET["s"] . '"';
        }
      ?> /><!--<input type="image" id="searchsubmit" src="<?php bloginfo('template_directory'); ?>/images/go_button.png" class="search_go" />-->
      </form>
    </div>
    <?php wp_nav_menu( array( 'theme_location' => 'languages-menu',
                            'container_class' => 'languages',
                            'walker' => new Top_Menu_Walker() ));?>
  </div>
  <?php wp_nav_menu( array( 'theme_location' => 'header-menu',
                            'container_class' => 'headerright nav-collapse',
                            'container'       => 'nav',
                            'menu_class'      => 'header-menu-list',
                            'walker' => new Walker_Header_Popup_Menu() ) ); ?>
                            
  <a href="javascript:;" id="navtoggle">
    <div id="menu-button">
      <span style="float: right;">Menu</span>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </a>

  <?php 
  if (get_field( 'vh_menu', $parent_id) ) {
    wp_nav_menu( array( 'theme_location' => get_field( 'vh_menu', $parent_id ),
                            'container' => 'nav',
                            'container_class' => '',
                            'container_id' => 'sidr',
                            'menu_class'      => 'header_main_menu'));
  } else {
    wp_nav_menu( array( 'theme_location' => 'header-menu',
                            'container' => 'nav',
                            'container_class' => '',
                            'container_id' => 'sidr',
                            'menu_class'      => 'header_main_menu'));
  } ?>
</div>

