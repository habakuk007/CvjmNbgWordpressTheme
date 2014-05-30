<?php 
    /* This part of code displays the news for the theme.
    * It accepts some external variables as parameters:
    * Please include this file with
    * require(locate_template('news-box.php'));
    * You can set the following variables:
    * $news_name: Name of the category containing the news posts
    * or
    * $news_id: ID of the category containing the news posts
    **/

    define("NumberOfPosts", 6);
    define("StdNewsCategoryName", 'news');
    define("DefaultImageUrlNamePart",'/images/NewsDefault'); //Should be 64x64px; if a image tries to add the first category to the image if 
    define("DefaultImageUrlExtension", '.jpg');
    define("TemplateDirectory", get_template_directory_uri());

    /*-------------------------*/
    $args = array('numberposts' => NumberOfPosts, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date");
    if (isset($news_name))
    {
      $args['category_name'] = $news_name;
    } else if (isset($news_id)) {
      $args['cat'] = $news_id;
    } else {
      $args['category_name'] = StdNewsCategoryName; //Standard News Category Name - 
    }
    $postslist = get_posts($args);
	function getImageUrl($post)
	{
        $attch = FALSE;
        if (is_object($post)) {
            $attch = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array(64,64));     
    	    if ($attch == false) {
                $attch = getAttachementImageUrl($post);
    	    }
    	    if ($attch == false) {
                return getDefaultImageUrl($post);
    	    }
    	    else {
			    return $attch[0];
    	    }
        } else {
           return $defaultImage; 
        }
	}
    function getAttachementImageUrl($post) 
    {
        $attch = false;
    	$attachments = get_posts(array('post_type' => 'attachment',
										'posts_per_page' => -1,
										'post_parent' => $post->ID));
    	if (count($attachments) > 0) {
    		$attch = wp_get_attachment_image_src($attachments[0]->ID, array(64,64));
    	}
        return $attch;
    }
    function getDefaultImageUrl($post)
    {
        $defaultImage = TemplateDirectory . DefaultImageUrlNamePart . DefaultImageUrlExtension;
        $categoryImagePath = getDefaultCategoryImagePath($post);
        if (file_exists($categoryImagePath)) {
            return getDefaultCategoryImageUrl($post);
        } else {
            return $defaultImage;
        }
    }
    function getDefaultCategoryImageUrl($post)
    {
        return TemplateDirectory . getDefaultCategoryImagePath($post);
    }
    function getDefaultCategoryImagePath($post)
    {
        $categoryName = get_the_category_name($post->ID);
        $categoryName = str_replace(' ', '_', $categoryName);
        return DefaultImageUrlNamePart . '_' . $categoryName  . DefaultImageUrlExtension;
    }
    function get_the_category_name($postId) {
        $cat = get_the_category($postId);
        return $cat[0]->cat_name;
    }
    function custom_excerpt_length($length) {     
	    return 125; //Change this number to any integer you like.
    }
    function new_excerpt_more($more) {
       global $post;
	   return ' &hellip;'; //' <a href="'. get_permalink($post->ID) . '">Read the Rest...</a>';
	}
    add_filter('excerpt_length', 'custom_excerpt_length' );
	add_filter('excerpt_more', 'new_excerpt_more');
?>
<div class="newsbox">
  <h1 class="news_headline">News</h1>
  <div class="partseperator"></div>
  <div class="news_list">	
     <ul class="media-list">
 <?php foreach ($postslist as $post) : setup_postdata($post); ?>
	    <li class="media">
            <h4 class="media-heading">
                <a href="<?php the_permalink(); ?>" 
                    title="<?php the_title(); ?>"><?php the_title(); ?></a> 
                    <small>vom <?php the_date(); ?></small>
            </h4>
            <a class="pull-left" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <?php if (has_post_thumbnail()) : ?>
                   <?php the_post_thumbnail('preview64x64'); ?>
                 <?php else : ?>
                 <img class="media-object size-64x64" width="64" height="64" 
                    src="<?php echo getImageUrl($post); ?>" 
                    alt="<?php the_title(); ?>">
                 <!-- Categorie Image URL: <?php echo getDefaultCategoryImageUrl($post) ?>-->
                 <?php endif; ?>
             </a>
            <div class="media-body">

				<div class="news-content">
                    <?php the_excerpt();?>
					<p><a class="btn btn-small" 
							href="<?php the_permalink(); ?>" 
							title="<?php the_title(); ?>">Alles lesen &raquo;</a><br />
                        <small>Von <?php the_author(); ?>  in <?php the_category(' &gt; '); ?></small>
                    </p>
				</div>
            </div>
        </li>
<?php endforeach; ?> 
	</ul>
  </div>

  --> Alle News...
</div>