<div class="news_box grid_8_4 grid_item">
  <h1 class="news_headline headline">News</h1>
  <hr class="fullseperator">
  <div class="news_promo_image_container">
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
          print "<img class=\"news_promo_img\" src=\"" . $image . "\" />\n";
        }
      }
    ?>
  </div>
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
  ?>
  Hier kommen die News</div>
</div>
