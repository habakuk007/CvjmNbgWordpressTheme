<?php

/* Form submit stuff */
$sent = false;
$to = array( "kontakt@cvjm-gostenhof.de",
  "grossgruendlach@cvjm-nuernberg.de",
  "kornmarkt@cvjm-nuernberg.de",
  "lichtenhof@cvjm-nuernberg.de",
  "webmaster@cvjm-nuernberg.de"
);
$subject = "Anfrage im First Contact";

$check_text = '';
$mail_text = '';
$vals = array_filter($_POST);
if (!empty($vals))
{
	/*
	array(4) { ["first_contact_mail"]=> string(31) "stefan.wagner@cvjm-nuernberg.de" ["first_contact_name"]=> string(6) "Stefan" ["first_contact_age"]=> string(14) "So Ende/Anfang" ["first_contact_issue"]=> string(112) "#2 Test, Test, Test, 1, 2, 3 Geht das so oder nicht so? Äh, daß ist sö ähnlich. Ciao! Stefan" } 
	*/
	$from = str_replace(':', '', strip_tags($vals["first_contact_mail"]));
	$headers = "From: <" . $from . "> \r\n" .
	  "Sender: webmaster@cvjm-nuernberg.de\r\n" . 
	  "X-FirstContactVersion: 10 \r\n" ;
	  
	  

  foreach ($vals as $key => $value) {
    $check_text .= $value;
    $mail_text .= $key . ": \r\n\t". $value . "\r\n";
  }

  if (strlen($check_text) > 0) {
    $sent = wp_mail($to, $subject, strip_tags($mail_text), $headers);
  }
}

get_header(); ?>

<?php $circle_name = 'circles_main'; require(locate_template('circles.php')); ?>

<div class="main_container">
  <H1>Vielen Dank f&uuml;r deine Nachricht</H!>
  <?php
    if (strlen($check_text) == 0) {
      echo '<p>Leider hast du nichts eingegeben. Deshalb wurde auch keine Nachricht verschickt.</p>' . "\n";
    } else if ($sent == false) {
      echo '<p>Es ist ein Fehler beim Senden der Nachricht aufgetreten. Bitte versuche es sp&auml;ter noch einmal.';
      echo 'Sollte das Problem l&aunl;nger bestehen, so gib doch bitte unserem Webmaster Bescheid.</p>' . "\n";
    } else {
      echo '<p>Deine Nachricht wurde erfolgreich verschickt.</p>' . "\n";
    }
	echo apply_filters('the_content', $post->post_content);
  ?>
</div>

<?php
  $pics = array( 'Bildergalerie_Logo.jpg', 'Videogalerie_Logo.jpg', 'Podcast_Logo.jpg', 'Treppenhaus_Lounge_Logo.jpg');
  $links = array( 'http://galerie.cvjm-nuernberg.de/', 'http://vimeo.com/cvjmnuernberg/videos',
      'http://podcasts.cvjm-nuernberg.de/', 'http://www.treppenhaus-lounge.de');
   require(locate_template('sidebar.php')); ?>

<?php get_footer(); ?>
