<?php
/*
Template Name: Verein Hauptseite
*/
get_header();

/* Save the values for our sub modules, because our page fields are gone
 * if the first sub module makes a new query */
  $circle_id = get_field( 'felder_verein_hauptseite_kreise' );
  $teaser_id = get_field( 'felder_verein_hauptseite_kreise_teaser' );
  $event_vid = get_field( 'felder_verein_hauptseite_vid' );
  $news_id = get_field( 'felder_verein_hauptseite_news' );
  $association_name = get_field( 'felder_verein_hauptseite_vereinsname' );
  $association_url = get_field( 'felder_verein_hauptseite_url' );
  $menu_name = get_field( 'felder_verein_hauptseite_menu' );
  $color = get_field( 'felder_verein_hauptseite_farbe' );
?>

<?php require(locate_template('circles.php')); ?>

<div class="main_container">
  <?php require(locate_template('teaser.php')); ?>

  <?php require(locate_template('event-box.php')); ?>

  <?php require(locate_template('news-box.php')); ?>
</div>

<div class="right_sidebar_container">
  <div class="association_menu" style="background-color: <?php echo $color ?>;">
    <p class="association_menu_headline"><?php echo $association_name ?></p>
    <p class="association_menu_url"><?php echo $association_url ?></p>
    <?php wp_nav_menu( array( 'theme_location' => $menu_name,
                            'container' => false) ); ?>
  </div>
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
