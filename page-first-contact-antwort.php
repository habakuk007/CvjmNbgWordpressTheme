<?php

/* Form submit stuff */
$sent = false;
$to = array( "kontakt@cvjm-gostenhof.de",
  "grossgruendlach@cvjm-nuernberg.de",
  "kornmarkt@cvjm-nuernberg.de",
  "lichtenhof@cvjm-nuernberg.de",
  "webmaster@cvjm-nuernberg.de"
);
//$to = array( "webmaster@cvjm-nuernberg.de" );
$subject = "Anfrage im First Contact";

$check_text = '';
$mail_text = '';
$isRobot = true;
$vals = array_filter($_POST);
if (!empty($vals))
{
	/*
	array(4) { ["first_contact_mail"]=> string(31) "stefan.wagner@cvjm-nuernberg.de" ["first_contact_name"]=> string(6) "Stefan" ["first_contact_age"]=> string(14) "So Ende/Anfang" ["first_contact_issue"]=> string(112) "#2 Test, Test, Test, 1, 2, 3 Geht das so oder nicht so? Äh, daß ist sö ähnlich. Ciao! Stefan" } 
	*/
	//var_dump($vals);
	$from = 'First Contact <webmaster@cvjm-nuernberg.de>';
	$replyTo = mb_encode_mimeheader($vals["first_contact_name"], 'utf-8', 'Q') . 
	           '<' . preg_replace('/\s+/', '', strip_tags($vals["first_contact_mail"])) . '>';
	$headers = "From: $from \r\n" .
	  "Reply-To: $replyTo \r\n" .
	  "Sender: webmaster@cvjm-nuernberg.de\r\n" . 
	  "X-FirstContactVersion: 12 \r\n" ;
	
	if (isset($vals['first_contact_mail']) && $vals['first_contact_mail'] !== '') {
		$mail_text = "Name: \t\t" . $vals['first_contact_name']. " \r\n" .
					 "E-Mail: \t" . $vals['first_contact_mail'] . " \r\n" .
					 "Alter: \t\t" . $vals['first_contact_age'] . "\r\n\r\n" .
					 $vals['first_contact_issue'];
		$mail_text = htmlspecialchars($mail_text);		 
		$check_text = $vals['first_contact_issue'] . $vals['first_contact_mail'];
	}
    
	$falle1 = (isset($vals['first_contact_diefalle']) && $vals['first_contact_diefalle'] !== '42');
	$falle2 = (isset($vals['first_contact_diefalle2']) && $vals['first_contact_diefalle2'] !== '');
	$isRobot = falle1 || falle2;
	echo $falle1 ? '<!-- Falle 1: true/-->' : '';
	echo $falle2 ? '<!-- Falle 2: true/-->' : '';
	
  if (strlen($check_text) > 0 && !$isRobot) {
    $sent = wp_mail($to, $subject, $mail_text, $headers);
  }
}

get_header(); ?>

<?php $circle_name = 'circles_main'; require(locate_template('circles.php')); ?>

<div class="main_container">
  <H1>Vielen Dank f&uuml;r deine Nachricht</H1>
  <?php
    if ($isRobot) {
	  echo '<p>Sorry, du schaust aus wie ein Roboter, wir k&ouml;nnen deine Nachricht leider nicht verschicken. Bitte schau auf der Kontaktseite vorbei, da findest du E-Mail-Adressen und Telefonnummern.';
	} else if (strlen($check_text) == 0) {
      echo '<p>Leider hast du nichts eingegeben. Deshalb wurde auch keine Nachricht verschickt.</p>' . "\n";
    } else if ($sent == false) {
      echo '<p>Es ist ein Fehler beim Senden der Nachricht aufgetreten. Bitte versuche es sp&auml;ter noch einmal.';
      echo 'Sollte das Problem l&aunl;nger bestehen, so gib doch bitte unserem Webmaster Bescheid.</p>' . "\n";
    } else {
      echo '<p>Sie wurde erfolgreich verschickt.</p>' . "\n";
    }
  ?>	
	<p>Deine Nachricht: <pre><?php echo $mail_text; ?></pre></p>
  <?php
	echo apply_filters('the_content', $post->post_content);
  ?>
</div>

<?php
  $pics = array( 'Bildergalerie_Logo.jpg', 'Videogalerie_Logo.jpg', 'Podcast_Logo.jpg', 'Treppenhaus_Lounge_Logo.jpg');
  $links = array( 'http://galerie.cvjm-nuernberg.de/', 'http://vimeo.com/cvjmnuernberg/videos',
      'http://podcasts.cvjm-nuernberg.de/', 'http://www.treppenhaus-lounge.de');
   require(locate_template('sidebar.php')); ?>

<?php get_footer(); ?>
