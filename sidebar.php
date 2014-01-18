<div class="right_sidebar_container">
  <div class="first_contact_container">
    <h1 class="first_contact_headline">first contact</h1>
    <p class="first_contact_desc">Interesse am CVJM? Neu in N&uuml;rnberg?</p>
    <p class="first_contact_desc">Felder einfach ausf&uumlllen und abschicken</p>
    <form>
      <input name="first_contact_mail" type="text" class="first_contact_text_input" placeholder="E-Mail Adresse">
      <input name="first_contact_name" type="text" class="first_contact_text_input" placeholder="Name">
      <input name="first_contact_age" type="text" class="first_contact_text_input" placeholder="Alter">
      <textarea name="first_contact_issue" class="first_contact_text_input" rows="4" placeholder="Anliegen"></textarea>
      <input type="submit" value="abschicken" class="first_contact_submit">
    </form>
  </div>
  <div class="map_container">
    <!--<img src="<?php bloginfo('template_directory'); ?>/images/map.png" class="map_image"/>-->
    <iframe width="100%" height="260" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.de/maps/ms?msa=0&amp;msid=202299304858622703127.0004eca77fc359d632122&amp;ie=UTF8&amp;t=m&amp;ll=49.430626,11.074905&amp;spn=0.116109,0.179214&amp;z=11&amp;output=embed"></iframe>
  </div>
  <?php the_widget('Losung_Widget', ''); ?>
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

	$pics = array( 'Treppenhaus_Lounge_Logo.jpg', 'Bildergalerie_Logo.jpg', 'Videogalerie_Logo.jpg');
	$links = array( 'http://www.treppenhaus-lounge.de', 'http://www.cvjm-nuernberg.de', 'http://www.cvjm-nuernberg.de');

	$i = 0;
    foreach	($pics as $img_name) {
      foreach ($list as $image) {
        if (strpos($image, $img_name)) {
          echo '<div class="sidebar_image_container">' . "\n";
          echo '<a href="' . $links[$i] . '"><img src="' . $image . '" class="sidebar_image"/></a>' . "\n";
		  echo '</div>';
		}
      }
	  $i++;
    }
  ?>
</div>