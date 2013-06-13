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

<div class="grid">
<?php get_template_part( 'news', 'box'); ?>
  <div class="grid_8_2 grid_item">
    <div class="frontpage_association">Vereine</div>
    <div class="frontpage_firstcontact">First Contact</div>
    <div class="frontpage_losung"><?php the_widget('Losung_Widget', 'showcopy=1'); ?></div>
  </div>
<div class="grid_8_2 grid_item">Nav Container</div>
</div>

<?php get_footer(); ?>
