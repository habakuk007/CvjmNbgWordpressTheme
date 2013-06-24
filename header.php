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
</head>

<body <?php body_class(); ?>>

<div class="header">
  <img src="<?php bloginfo('template_directory'); ?>/images/logo.png" class="headlogo"/>
  <div class="headerright staticmenu">
    &Uuml;ber uns&nbsp;|&nbsp;Vereine
  </div>
  <div class="headerright languages">
    Deutsch&nbsp;|&nbsp;English
  </div>
  <?php wp_nav_menu( array( 'theme_location' => 'header-menu',
                            'container_class' => 'headerright' ) ); ?>
</div>
<hr class="fullseperator">
