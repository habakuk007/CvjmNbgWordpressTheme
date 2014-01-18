<?php /* This part of code displays the news for the theme.
       * It accepts some external variables as parameters:
       * Please include this file with
       * require(locate_template('news-box.php'));
       * You can set the following variables:
       * $news_name: Name of the category containing the news posts
       * or
       * $news_id: ID of the category containing the news posts
       **/
?>
<div class="newsbox">
  <h1 class="news_headline">News</h1>
  <div class="partseperator"></div>
  <div class="news_list">
  <?php
    $query_args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
        );
    if (isset($news_name))
    {
      $query_args['category_name'] = $news_name;
    } else if (isset($news_id)) {
      $query_args['cat'] = $news_id;
    } else {
      $query_args['category_name'] = 'news';
    }
    $news_query = new WP_Query(
        $query_args
      );

      while( $news_query->have_posts() ) {
        $news_query->the_post();
        echo '<a class="newstitle" href="#" rel="#news_' . get_the_ID() . '">' . get_the_title() . '</a>' . "\n";
        echo '<div class="newsshorttext">' . "\n";
        global $more;
        $more = false;
        the_content('');
        echo '</div>' . "\n";
        echo '<div class="simple_overlay" id="news_' . get_the_ID() . '">' . "\n";
        echo '<h2>' . get_the_title() . '</h2>' . "\n";
        $more = true;
        the_content('', true);
        echo '</div>' . "\n";
      }
  ?>
  </div>
</div>
