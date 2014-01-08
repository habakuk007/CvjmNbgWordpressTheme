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

      $number = rand(0,2);

      do {
        switch ($number) {
        case 0:
          $picture_name = 'picture_one';
          break;
        case 1:
          $picture_name = 'picture_two';
          break;
        case 2:
          $picture_name = 'picture_three';
          break;
        }
      } while ($number-- > 0 && strlen(get_field($picture_name, $post->ID)) == 0);

      echo '<span class="circle_span">';
      echo '<a href="' . get_field('page_link', $post->ID) . '">' . "\n";
      echo '<img src=" ' . get_field($picture_name, $post->ID) . '" class="circle_image" /></a>';
      echo '<br>' . get_the_title() . '</span>';
    }
  ?>
</div>
