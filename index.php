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

  <?php $event_vid = '1495,1496,1497,1498,1499,1500'; $event_add_query = 'highlight=high'; require(locate_template('event-box.php')); ?>

  <?php $news_name = 'news'; require(locate_template('news-box.php')); ?>
</div>

<div class="right_sidebar_container">
  <div class="first_contact_container">
    <h1 class="first_contact_headline">first contact</h1>
    <p class="first_contact_desc">Interesse am CVJM? Neu in Nürnberg?</p>
    <p class="first_contact_desc">Felder einfach ausfüllen und abschicken</p>
    <form>
      <input name="first_contact_mail" type="text" class="first_contact_text_input" placeholder="E-Mail Adresse">
      <input name="first_contact_name" type="text" class="first_contact_text_input" placeholder="Name">
      <input name="first_contact_age" type="text" class="first_contact_text_input" placeholder="Alter">
      <textarea name="first_contact_issue" class="first_contact_text_input" rows="4" placeholder="Anliegen"></textarea>
      <input type="submit" value="abschicken" class="first_contact_submit">
    </form>
  </div>
  <div class="map_container">
    <!--<img src="<?php bloginfo('template_directory'); ?>/images/map.png" class="map_image"/>-->
    <iframe width="100%" height="260" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.de/maps/ms?msa=0&amp;msid=202299304858622703127.0004eca77fc359d632122&amp;ie=UTF8&amp;t=m&amp;ll=49.430626,11.074905&amp;spn=0.116109,0.179214&amp;z=11&amp;output=embed"></iframe>
  </div>
  <?php the_widget('Losung_Widget', ''); ?>
  <div class="photo_galery_container">
    <img src="<?php bloginfo('template_directory'); ?>/images/galery.png" class="photo_galery_image"/>
    <span class="photo_galery_label">Bildergalerie</span>
  </div>
  <div class="video_container">
    <img src="<?php bloginfo('template_directory'); ?>/images/galery.png" class="video_image"/>
    <span class="video_label">Videos</span>
  </div>
</div>

<?php get_footer(); ?>
