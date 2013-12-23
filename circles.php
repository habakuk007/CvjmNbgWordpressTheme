<?php /* This part of code displays the circles for the theme.
       * It accepts some external variables as parameters:
       * Please include this file with
       * require(locate_template('circles.php'));
       * You can set the following variables:
       * $circle_name: Name of the category containing the news posts
       * or
       * $circle_id: ID of the category containing the news posts
       **/
?>

<div id="circles" class="circles_container">
  <?php
    $circles_args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1
        );
    if (isset($circle_name))
    {
      $circles_args['category_name'] = $circle_name;
    } else if (isset($circle_id)) {
      $circles_args['cat'] = $circle_id;
    } else {
      $circles_args['category_name'] = 'circles_main';
    }
    $news_query = new WP_Query( $circles_args );

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
