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
        //the_content('');
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

<?php 
    $args = array( 'numberposts' => 6, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date");
    $postslist = get_posts( $args );
	function getImageUrl ($post)
	{
		$defaultUrl = "himg/blume.jpg";
    	$attch = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array(64,64));
    	if ($attch == false) {
    		$attachments = get_posts( array('post_type' => 'attachment',
											'posts_per_page' => -1,
											'post_parent' => $post->ID));
    		$attch = wp_get_attachment_image_src($attachments[0]->ID, array(64,64));
    	}
    	if ($attch == false) {
    		return $defaultUrl; 
    	}
    	else {
			return $attch[0];
    	}
	}
	function new_excerpt_more($more) {
       global $post;
	return ' &hellip;'; //' <a href="'. get_permalink($post->ID) . '">Read the Rest...</a>';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
?>
	<ul class="media-list">
 
<?php foreach ($postslist as $post) : setup_postdata($post); ?>
	
	<li class="media">
            <a class="pull-left" href="<?php the_permalink(); ?>">
                <img class="media-object size-64x64" width="64" height="64" src="<?php echo getImageUrl($post); ?>">
             </a>
            <div class="media-body">
				<h4 class="media-heading"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> <small>vom <?php the_date(); ?></small></h4>
                
				<div class="news-content">
					<p><?php the_content(); ?> 
					<!--<a class="btn btn-small" 
							href="<?php the_permalink(); ?>" 
							title="<?php the_title(); ?>">Alles lesen &raquo;</a>/--><br /></p>
				</div>
            </div>
        </li>
<?php endforeach; ?> 
	</ul>