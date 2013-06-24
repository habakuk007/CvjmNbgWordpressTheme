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

<div id="frontpage_first_row" class="grid">
  <div id="frontpage_newsbox">
    <?php get_template_part( 'news', 'box'); ?>
  </div>
  <div id="frontpage_quicknav">
    <img src="<?php bloginfo('template_directory'); ?>/images/vereine_frontpage.png" class="frontpage_association_img" />
    <img src="<?php bloginfo('template_directory'); ?>/images/firstcontact_frontpage.png" class="frontpage_firstcontact_img" />
    <?php the_widget('Losung_Widget', ''); ?>
  </div>
<div id="frontpage_group_list">
  <img src="<?php bloginfo('template_directory'); ?>/images/kinder_frontpage.png" class="frontpage_nav_img" />
  <img src="<?php bloginfo('template_directory'); ?>/images/kinder_frontpage.png" class="frontpage_nav_img" />
  <img src="<?php bloginfo('template_directory'); ?>/images/kinder_frontpage.png" class="frontpage_nav_img" />
  <img src="<?php bloginfo('template_directory'); ?>/images/kinder_frontpage.png" class="frontpage_nav_img" />
  <img src="<?php bloginfo('template_directory'); ?>/images/kinder_frontpage.png" class="frontpage_nav_img" />
  <img src="<?php bloginfo('template_directory'); ?>/images/kinder_frontpage.png" class="frontpage_nav_img" />
  <img src="<?php bloginfo('template_directory'); ?>/images/kinder_frontpage.png" class="frontpage_nav_img" />
  <img src="<?php bloginfo('template_directory'); ?>/images/kinder_frontpage.png" class="frontpage_nav_img" />
</div>
</div>

<div id="frontpage_second_row" class="grid">
  <div id="frontpage_eventbox">
    <?php get_template_part( 'event', 'box'); ?>
  </div>
  <div id="frontpage_quicklink">
    <img src="<?php bloginfo('template_directory'); ?>/images/galery_frontpage.png" id="frontpage_galery" />
    <img src="<?php bloginfo('template_directory'); ?>/images/video_frontpage.png"  id="frontpage_video"/>
  </div>
</div>

<?php get_footer(); ?>
