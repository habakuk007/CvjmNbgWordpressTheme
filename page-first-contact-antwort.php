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
$headers = 'From: '. $to . "\r\n" .
  'Reply-To: webmaster@cvjm-nuernberg.de' . "\r\n";

$check_text = '';
$mail_text = '';
$vals = array_filter(_$POST);
if (!empty($vals))
{
  foreach ($vals as $key => $value) {
    $check_text .= $value;
    $mail_text .= $key . ': '. $value . "\n";
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
    if (strlen($check_text) > 0) {
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
