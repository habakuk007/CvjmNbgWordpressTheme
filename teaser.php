<?php /* This part of code displays the teaser for the theme.
       * It accepts some external variables as parameters:
       * Please include this file with
       * require(locate_template('circles.php'));
       * You can set the following variables:
       * $teaser_name: Name of the category containing the teaser posts
       * or
       * $teaser_id: ID of the category containing the news posts
       **/
?>

  <?php
    $teaser_args =  array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1
        );

    if (isset($teaser_name))
    {
      $teaser_args['category_name'] = $teaser_name;
    } else if (isset($teaser_id)) {
      $teaser_args['cat'] = $teaser_id;
    } else {
      $teaser_args['category_name'] = 'teaser';
    }

    $teaser_query = new WP_Query( $teaser_args );

    $imgAvail = false;
	$first_img = false;
    while( $teaser_query->have_posts() ) {
      $teaser_query->the_post();
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
		  $first_img = get_field( 'show_image' );
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
	  if ($first_img !== false)
	  {
	    echo '<noscript><img src="';
        echo the_field( 'show_image' );
        echo '" style="width: 98%" /></noscript>';
	  }
    }
  ?>
