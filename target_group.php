<?php
/*
Template Name: Zielgruppe
*/
get_header();
$news_id = get_field( 'categorie_news' )?>

<div class="target_group_headline_container">
  <span class="target_group_headline"><?php the_title()?></span>
  <img src="<?php the_field( 'circle_picture' )?>" class="target_group_circle_image" />
</div>

<div class="target_group_desc_container">
  <div class="target_group_desc_col">
    <h1 class="target_group_desc_headline"><?php the_field( 'title_first_col' ) ?></h1>
    <p class="target_group_desc_body"><?php the_field( 'content_first_col' ) ?></p>
  </div>
  <div class="target_group_desc_col">
    <h1 class="target_group_desc_headline"><?php the_field( 'title_second_col' ) ?></h1>
    <p class="target_group_desc_body"><?php the_field( 'content_second_col' ) ?></p>
  </div>
  <div class="target_group_desc_col">
    <h1 class="target_group_desc_headline"><?php the_field( 'title_third_col' ) ?></h1>
    <p class="target_group_desc_body"><?php the_field( 'content_third_col' ) ?></p>
  </div>
</div>

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

<div class="main_container">
  <?php require(locate_template('news-box.php')); ?>
</div>

<div class="right_sidebar_container">
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
