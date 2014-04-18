<?php
/*
Template Name: Zielgruppe
*/
get_header();
wp_reset_query();
$news_id = get_field( 'categorie_news' );
$target_ids = '';
$groups = get_field('zielgruppe');
if ($groups) {
  $target_ids = '&people=';
  $first = true;
  foreach ($groups as $id) {
    if ($first == false) {
      $target_ids .= ',';
    }
    $target_ids .= $id;
    $first = false;
  }
}
$cvjms = get_field('veranstalter');
if ($cvjms) {
  $event_vid = ''
  $first = true;
  foreach ($cvjms as $id) {
    if ($first == false) {
      $event_vid .= ',';
    }
    $event_vid .= $id;
    $first = false;
  }
}?>

<div class="target_group_headline_container">
  <span class="target_group_headline"><?php the_title()?></span>
  <img src="<?php the_field( 'circle_picture' )?>" class="target_group_circle_image" />
</div>

<div class="target_group_desc_container">
  <div class="target_group_desc_col target_group_desc_col_left">
    <h1 class="target_group_desc_headline"><?php the_field( 'title_first_col' ) ?></h1>
    <p class="target_group_desc_body"><?php the_field( 'content_first_col' ) ?></p>
  </div>
  <div class="target_group_desc_col target_group_desc_col_middle">
    <h1 class="target_group_desc_headline"><?php the_field( 'title_second_col' ) ?></h1>
    <p class="target_group_desc_body"><?php the_field( 'content_second_col' ) ?></p>
  </div>
  <div class="target_group_desc_col target_group_desc_col_right">
    <h1 class="target_group_desc_headline"><?php the_field( 'title_third_col' ) ?></h1>
    <p class="target_group_desc_body"><?php the_field( 'content_third_col' ) ?></p>
  </div>
</div>

<div class="responsible_container">
  <h1 class="target_group_contact_headline">Ansprechpartner</h1>

<?php
  $count = 0;
  $contact_query = new WP_Query(
      array(
      'post_type' => 'post',
      'post_status' => 'publish',
      'cat' => get_field( 'responsible_contact_category' ),
      'posts_per_page' => -1
      )
    );

  while( $contact_query->have_posts() ) {
    if (($count % 3) == 0)
    {
      if ($count >= 3)
      {
        echo '</div>';
      }
      echo '<div class="target_group_contact_container">' . "\n";
    }
    $contact_query->the_post();
    echo '<div class="target_group_contact_entry">' . "\n";
    echo '<img src="';
    echo the_field( 'responsible_image' );
    echo '" class="target_group_contact_image" />' . "\n";
    echo '<span>';
    echo the_field( 'responsible_association' );
    echo '<br>' . "\n";
    echo the_field( 'responsible_name' );
    echo '<br>' . "\n";
    echo the_field( 'responsible_address' );
    echo '<br>' . "\n";
    echo '</span>' . "\n";
    echo '</div>' . "\n";
    $count++;
  }
?>
  </div>
</div>

<div class="main_container">
  <?php require(locate_template('news-box.php')); ?>
  
  <?php $event_count = 100000; $event_add_query = 'eventtype=2' . $target_ids; $event_headline = 'Gruppen'; $event_list_mode = true; require(locate_template('event-box.php')); ?>
  <?php $event_count = 100000; $event_add_query = 'eventtype=5' . $target_ids; $event_headline = 'Freizeiten'; $event_list_mode = true; require(locate_template('event-box.php')); ?>
  <?php $event_count = 100000; $event_add_query = 'eventtype=7' . $target_ids; $event_headline = 'Specials'; $event_list_mode = true; require(locate_template('event-box.php')); ?>
</div>

<div class="right_sidebar_container">
  <?php $pics = array( 'Bildergalerie_Logo.jpg', 'Videogalerie_Logo.jpg', 'Podcast_Logo.jpg');
    $links = array( 'http://galerie.cvjm-nuernberg.de/', 'http://vimeo.com/cvjmnuernberg/videos',
      'http://podcasts.cvjm-nuernberg.de/');
  require(locate_template('sidebar_links.php')); ?>
</div>

<?php get_footer(); ?>
