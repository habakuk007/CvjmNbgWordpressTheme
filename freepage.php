<?php
/*
Template Name: Allgemeine Freiseite
*/

get_header(); ?>

<?php $circle_name = 'circles_main'; require(locate_template('circles.php')); ?>

<div class="main_container">
  <?php
    wp_reset_query();
    //echo $post->post_content;
	echo apply_filters('the_content', $post->post_content);
  ?>
</div>

<?php require(locate_template('sidebar.php')); ?>

<?php get_footer(); ?>
