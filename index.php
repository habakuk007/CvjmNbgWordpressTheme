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

<div id="circles" class="circles_container">
  <?php
    $news_query = new WP_Query(
        array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'category_name' => 'circles_main',
        'posts_per_page' => -1
        )
      );

    while( $news_query->have_posts() ) {
      $news_query->the_post();
      $args = array(
        'post_type' => 'attachment',
        'numberposts' => -1,
        'post_status' => null,
        'post_parent' => $post->ID
      );

      $attachments = get_posts( $args );
      if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
          echo '<span class="circle_span">';
          $image_data = wp_get_attachment_image_src( $attachment->ID );
          echo '<img src=" ' . $image_data[0] . '" class="circle_image" />';
          echo '<br>' . get_the_title() . '</span>';
        }
      }
    }
  ?>
</div>

<div class="main_container">
  <?php
    $news_query = new WP_Query(
        array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'category_name' => 'teaser',
        'posts_per_page' => -1
        )
      );

    $imgAvail = false;
    while( $news_query->have_posts() ) {
      $news_query->the_post();
      $startDate = DateTime::createFromFormat('Ymd', get_field( 'show_start' ));
      $endDate = DateTime::createFromFormat('Ymd', get_field( 'show_end' ));
      $nowDate = new DateTime("now");
      if ($startDate <= $nowDate && $nowDate <= $endDate)
      {
        if ($imgAvail == false)
        {
          echo '<div class="flexslider">';
          echo '<ul class="slides">';
          $imgAvail = true;
        }
        echo '<li>';
        echo '<img src="';
        echo the_field( 'show_image' );
        echo '" />';
        echo '</li>';
      }
    }

    if ($imgAvail == true)
    {
      echo '</ul></div>';
    }
  ?>
  <div class="eventbox">
    <?php get_template_part( 'event', 'box'); ?>
  </div>
  <div class="newsbox">
    <?php get_template_part( 'news', 'box'); ?>
  </div>
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
    <img src="<?php bloginfo('template_directory'); ?>/images/map.png" class="map_image"/>
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
