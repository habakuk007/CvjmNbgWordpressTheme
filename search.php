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

global $wp_query;
global $wp;
$is_evtermine = false;
 
get_header(); ?>

<?php $circle_name = 'circles_main'; require(locate_template('circles.php')); ?>

<div class="main_container">
  <?php
    if (array_key_exists('post_type', $wp_query->query) && strcmp($wp_query->query['post_type'], 'page') == 0) {
	  // It is page search
      echo '<span class="search_headline search_headline_active">Seiten</span>';
	} else {
      echo '<span class="search_headline"><a href="';
	  echo add_query_arg(array('s' => $wp_query->query['s'], 'post_type' => 'page', 'orderby' => 'title', 'order' => 'ASC'), '', home_url( $wp->request ));
	  echo '">Seiten</a></span>';
	}
	if ((array_key_exists('post_type', $wp_query->query) && strcmp($wp_query->query['post_type'], 'post') == 0) &&
	     (array_key_exists('category_name', $wp_query->query) || stripos($wp_query->query['category_name'], 'news') !== false)) {
      echo '<span class="search_headline search_headline_active">News</span>';
	} else {
	  echo '<span class="search_headline"><a href="';
	  echo add_query_arg(array('s' => $wp_query->query['s'], 'post_type' => 'post', 'category_name' => 'news', 'orderby' => 'title', 'order' => 'ASC'), '', home_url( $wp->request ));
	  echo '">News</a></span>';
	}
	if (array_key_exists('termine', $_GET))
	{
	  echo '<span class="search_headline search_headline_active">Termine</span>'. "\n";
	  $is_evtermine = true;
	} else {
	  echo '<span class="search_headline"><a href="';
	  echo add_query_arg(array('s' => $wp_query->query['s'], 'termine' => 'yes'), '', home_url( $wp->request ));
	  echo '">Termine</a></span>' . "\n";
	}
	
    if ($is_evtermine === false) {
	  if (have_posts()) {
        while (have_posts()) {
	      the_post();
	      echo '<p class="search_result">';
	      echo '<a href="';
	      echo the_permalink();
	      echo '" class="search_result_link">';
	      echo the_title();
	      echo '</a><br />';
	      echo the_excerpt();
	      echo '</p>' . "\n";
	    }
        echo '<p align="right">';
	    echo previous_posts_link('&laquo; Vorherige Treffer;ge ');
	    echo ' | ';
	    echo next_posts_link(' Weitere Treffer &raquo;');
	    echo '</p>' . "\n";
      } else {
        echo '<p class="search_result">Keine Treffer</p>';
	  }
	} else {
	  echo '<div style="height: 0.5em"></div>';
	  $event_vid = '1495,1496,1497,1498,1499,1500';
	  $event_count = 20; $event_add_query = 'q=' . $wp_query->query['s'];
	  $event_show_filter = array('highlight' => 'no', 'noheadline' => 'yes');
	  require(locate_template('event-box.php'));
	}
  ?>
</div>

<?php require(locate_template('sidebar.php')); ?>

<?php get_footer(); ?>
