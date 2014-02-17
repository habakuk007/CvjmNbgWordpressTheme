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
  <h1 class="search_headline">Seiten</h1>
  <div class="partseperator"></div>
  <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
	  <?php 
	    if (strcmp(get_post_type( get_the_ID() ), 'page') == 0) {
		  echo '<p class="search_result">';
		  echo '<a href="';
		  echo the_permalink();
		  echo '" class="search_result_link">';
		  echo the_title();
		  echo '</a><br />';
		  echo the_excerpt();
		  echo '</p>';
		}
	  ?>
    <?php endwhile; ?>
  <h1 class="search_headline">News</h1>
  <div class="partseperator"></div>
	<?php wp_reset_query(); ?>
	<?php while (have_posts()) : the_post(); ?>
      <?php
		$cats = get_the_category();
		if ($cats) {
		  foreach ($cats as $category) {
			if (stripos($category->name, 'news') === 0) {
			  echo '<p class="search_result">';
		      echo '<a href="';
		      echo the_permalink();
		      echo '" class="search_result_link">';
		      echo the_title();
		      echo '</a><br />';
		      echo the_excerpt();
			  echo '</p>';
			  break;
			}
		  }
		}
	  ?>
	<?php endwhile; ?>
    <!--<p align="center"><?php next_posts_link('&laquo; &Auml;ltere Eintr&auml;ge') ?> | <?php previous_posts_link('Neuere Eintr&auml;ge &raquo;') ?></p>-->

  <?php else : ?>
    <h2>Leider nichts gefunden</h2>

   <?php endif; ?>
</div>

<?php require(locate_template('sidebar.php')); ?>

<?php get_footer(); ?>
