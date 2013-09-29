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
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/js/flexslider.css" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.flexslider-min.js"></script>

<script type="text/javascript" charset="utf-8">
  $(window).load(function() {
    $('.flexslider').flexslider();
  });
</script>

<!-- FlexSlider end -->

</head>

<body <?php body_class(); ?>>

<div class="header">
  <img src="<?php bloginfo('template_directory'); ?>/images/logo_main.png" class="headlogo"/>
  <div class="headerright staticmenu">
    &Uuml;ber uns&nbsp;|&nbsp;Vereine&nbsp;|&nbsp;Kontakt&nbsp;|&nbsp;Intern
  </div>
  <div class="headerright searchform">
    <form><input type="text" placeholder="Suchbegriff eingeben" size="30" class="search_field" />
    <input type="image" src="<?php bloginfo('template_directory'); ?>/images/go_button.png" class="search_go" />
    </form>
  </div>
  <div class="headerright languages">
    Deutsch&nbsp;|&nbsp;English&nbsp;|&nbsp;Espanol
  </div>
  <?php wp_nav_menu( array( 'theme_location' => 'header-menu',
                            'container_class' => 'headerright' ) ); ?>
</div>
<hr class="fullseperator veryheight">
