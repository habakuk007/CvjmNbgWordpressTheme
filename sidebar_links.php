  <?php
    if ( isset($parent_id) && have_rows('vh_right_links', $parent_id) ) {
      while ( have_rows('vh_right_links', $parent_id) ) {
        the_row();
        echo '<div class="sidebar_image_container">' . "\n";
        echo '<a href="';
        if ( strlen(get_sub_field('url_zu_externer_seite', $parent_id)) == 0 ) {
          the_sub_field('interne_seite', $parent_id);
        } else {
          the_sub_field('url_zu_externer_seite', $parent_id);
        }
        echo '" target="_blank"><img src="' . get_sub_field('bild', $parent_id) . '" class="sidebar_image"/></a>' . "\n";
        echo '</div>';        
      }
	  } else if (isset($pics) && isset($links)) {
      $media_query = new WP_Query(
        array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'posts_per_page' => -1,
        )
      );
      $list = array();
      foreach ($media_query->posts as $post) {
        $list[] = wp_get_attachment_url($post->ID);
      }

      $i = 0;
      foreach	($pics as $img_name) {
        foreach ($list as $image) {
          if (strpos($image, $img_name)) {
            echo '<div class="sidebar_image_container">' . "\n";
            echo '<a href="' . $links[$i] . '" target="_blank"><img src="' . $image . '" class="sidebar_image"/></a>' . "\n";
            echo '</div>';
          }
        }
      $i++;
      }
	  }
  ?>
