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

<!-- FlexSlider -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/js/flexslider.css" type="text/css">
<!-- FlexMenu -->
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/css/responsive-nav.css" type="text/css">
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>-->
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.tools.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.flexslider-min.js"></script>
<!-- FlexMenu -->
<script src="<?php bloginfo('template_directory'); ?>/js/responsive-nav.min.js"></script>

<script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider({ directionNav: false });
  });
</script>

<!-- FlexSlider end -->

</head>

<body <?php body_class(); ?>>

<div class="header">
  <img src="<?php bloginfo('template_directory'); ?>/images/logo_main.png" class="headlogo"/>
  <?php wp_nav_menu( array( 'theme_location' => 'top-short-menu',
                            'container_class' => 'header_top_menu',
                            'walker' => new Top_Menu_Walker() ));?>
  <div class="headerright searchform">
    <form role="search" method="get" id="searchform" action="/wordpress/">
    <input type="text" placeholder="Suchbegriff eingeben" size="30" name="s" id="s" class="search_field" />
    <input type="image" id="searchsubmit" src="<?php bloginfo('template_directory'); ?>/images/go_button.png" class="search_go" />
    </form>
  </div>
  <div class="headerright languages">
    Deutsch&nbsp;|&nbsp;English&nbsp;|&nbsp;Espanol
  </div>
  <?php wp_nav_menu( array( 'theme_location' => 'header-menu',
                            'container_class' => 'headerright nav-collapse',
                            'container'       => 'nav',
                            'menu_class'      => 'header-menu-list',
                            'walker' => new Walker_Header_Popup_Menu() ) ); ?>
  <script type="text/javascript" charset="utf-8">
    $('#menu-header-menu li').hover(
      function() {
        $(this).find('ul').css('visibility', 'visible');
      },
      function() {
        $(this).find('ul').css('visibility', 'hidden');
      }
    );
    $('#menu-header-menu li ul li a').click(
      function() {
        $(this).find('ul').css('visibility', 'visible');
      }
    );

    $(document).ready(function() {
      $("a[rel]").overlay();
    });

  // FlexMenu
  var navigation = responsiveNav(".nav-collapse", {
    animate: true, // Boolean: Use CSS3 transitions, true or false
    transition: 400, // Integer: Speed of the transition, in milliseconds
    label: "Menu", // String: Label for the navigation toggle
    insert: "after", // String: Insert the toggle before or after the navigation
    customToggle: "", // Selector: Specify the ID of a custom toggle
    openPos: "relative", // String: Position of the opened nav, relative or static
    navClass: "nav-collapse", // String: Default CSS class. If changed, you need to edit the CSS too!
    jsClass: "js", // String: 'JS enabled' class which is added to <html> el
    init: function(){}, // Function: Init callback
    open: function(){}, // Function: Open callback
    close: function(){} // Function: Close callback
  });
  </script>
</div>
<hr class="fullseperator veryheight">
