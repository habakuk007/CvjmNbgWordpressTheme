  <h1 class="news_headline headline">News</h1>
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
          echo '<img class="news_promo_img" src="' . $image . '" />';
        }
      }
    ?>
  <div class="news_list">
  <?php
    $news_query = new WP_Query(
        array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'category_name' => 'news',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
        )
      );

      while( $news_query->have_posts() ) {
        $news_query->the_post();
        echo '<span class="newstitle">' . get_the_title() . '</span>';
        echo '<span class="newsshorttext">' . the_content('mehr...'). '</span>';
      }
  ?>
  </div>
