<?php
/*
Template Name: Allgemeine Freiseite
*/

get_header(); ?>

<?php $circle_name = 'circles_main'; require(locate_template('circles.php')); ?>

<div class="main_container">
  <?php
    wp_reset_query();
	echo apply_filters('the_content', $post->post_content);
  ?>
</div>

<?php
  $pics = array( 'Bildergalerie_Logo.jpg', 'Videogalerie_Logo.jpg', 'Podcast_Logo.jpg', 'Treppenhaus_Lounge_Logo.jpg');
  $links = array( 'http://galerie.cvjm-nuernberg.de/', 'http://vimeo.com/cvjmnuernberg/videos',
      'http://podcasts.cvjm-nuernberg.de/', 'http://www.treppenhaus-lounge.de');
   require(locate_template('sidebar.php')); ?>

<?php get_footer(); ?>
