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

	$pics = array( 'Treppenhaus_Lounge_Logo.jpg', 'Bildergalerie_Logo.jpg', 'Videogalerie_Logo.jpg', 'Podcast_Logo.jpg');
	$links = array( 'http://www.treppenhaus-lounge.de', 'http://galerie.cvjm-nuernberg.de/',
	  'http://vimeo.com/cvjmnuernberg/videos', 'http://podcasts.cvjm-nuernberg.de/');

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
  ?>
