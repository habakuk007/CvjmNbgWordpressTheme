  <h1 class="event_headline">N&auml;chste Termine</h1>
  <hr class="fullseperator">
    <?php
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

      foreach ($list as $image) {
        if (strpos($image, "news_frontpage.png")) {
          echo '<img class="event_promo_img" src="' . $image . '" />';
        }
      }
    ?>
  <div class="event_list">
    <?php the_widget('EvTermine_Widget', array('reqstr' => 'vid=1498&itemsPerPage=5')); ?>
  </div>
