  <h1 class="news_headline">News</h1>
  <hr class="partseperator">
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
        echo '<span class="newstitle">' . get_the_title() . '</span>' . "\n";
        echo '<div class="newsshorttext">' . "\n";
        the_content('mehr...');
        echo '</div>' . "\n";
      }
  ?>
  </div>
