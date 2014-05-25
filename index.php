<?php
/**
 * The main template file of the CVJM Nuernberg layout template.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage CVJM_Nuernberg
 * @since CVJM_Nuernberg 1.0
 */

get_header(); ?>

<?php $circle_name = 'circles_main'; require(locate_template('circles.php')); ?>

<div class="main_container">
  <?php $teaser_name = 'teaser'; require(locate_template('teaser.php')); ?>

  <?php $event_vid = '1495,1496,1497,1498,1499,1500'; $event_add_query = 'highlight=high'; 
    $event_show_filter = array('highlight' => 'yes',
      'event' => 'yes',
      'kultur' => 'yes',
      'glaube' => 'yes',
      'gruppe' => 'yes',
      'sport' => 'yes',
      'urlaub' => 'yes');
    require(locate_template('event-box.php')); ?>

  <?php $news_name = 'news'; require(locate_template('news-box.php')); ?>

</div>

<?php 
    $pics = array( 'Bildergalerie_Logo.jpg', 'Videogalerie_Logo.jpg', 'Podcast_Logo.jpg', 'Treppenhaus_Lounge_Logo.jpg');
    $links = array( 'http://galerie.cvjm-nuernberg.de/', 'http://vimeo.com/cvjmnuernberg/videos',
      'http://podcasts.cvjm-nuernberg.de/', 'http://www.treppenhaus-lounge.de');
    require(locate_template('sidebar.php')); ?>

<?php get_footer(); ?>
