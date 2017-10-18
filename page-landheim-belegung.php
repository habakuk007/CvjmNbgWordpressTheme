<?php
require('/home/cvjmweb/database_landheim.inc');
require_once(locate_template('recaptchalib.php'));
// ReCaptcha config
$publickey = "6LdBEe4SAAAAAAKMLr08QJmjF9xWTcxQelmTAT6a"; // you got this from the signup page
$privatekey = "6LdBEe4SAAAAAOSbLqRSnYd_9fo0VYDXBfNSR18a";

get_header();

$parent_id = getAssociationParent();

/* Save the values for our sub modules, because our page fields are gone
 * if the first sub module makes a new query */
  $circle_id = get_field( 'vh_category_circles', $parent_id );
  $association_name = get_field( 'vh_association_name', $parent_id );
  $association_url = get_field( 'vh_url', $parent_id );
  $menu_name = get_field( 'vh_menu', $parent_id );
  $color = get_field( 'vh_color', $parent_id );
?>

<?php require(locate_template('circles.php')); ?>

<div class="main_container">
  <?php
  $db = new Landheim_Database;
  $db->OpenDatabase();

  echo get_page_template_slug( get_the_ID() );
  
  $monthname = array("Januar", "Februar", "M&auml;rz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");

  $fehlertext = "";
  $action_done = 0;
  if (array_key_exists('comemonth', $_POST)) {
    $action_done = 1;
    // Check parameters
    if (!checkdate($_POST["comemonth"], $_POST["comeday"], $_POST["comeyear"])) {
      $fehlertext .= "<p style=\"color:#FF0000;\">Bitte geben Sie ein g&uuml;ltiges Anreisedatum ein</p>";
    }

    if (!checkdate($_POST["gomonth"], $_POST["goday"], $_POST["goyear"])) {
      $fehlertext .= "<p style=\"color:#FF0000;\">Bitte geben Sie ein g&uuml;ltiges Abreisedatum ein</p>";
    }

    if (strlen($_POST["person"]) == 0) {
      $fehlertext .= "<p style=\"color:#FF0000;\">Bitte geben Sie ihren Namen ein</p>";
    }

    if (strlen($_POST["phone"]) == 0) {
      $fehlertext .= "<p style=\"color:#FF0000;\">Bitte geben Sie ihre Telefonnummer ein</p>";
    }

    if (strlen($_POST["mail"]) == 0) {
      $fehlertext .= "<p style=\"color:#FF0000;\">Bitte geben Sie ihre Mailadresse ein</p>";
    }
    
    $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

    if (!$resp->is_valid) {
      // What happens when the CAPTCHA was entered incorrectly
      $fehlertext .= "<p style=\"color:#FF0000;\">Bitte geben Sie den richtigen Sicherheitscode ein</p>";
    }

    if (strlen($fehlertext) == 0) {

      $anfrage = "Ankunft: ".$_POST["comeday"].".".$_POST["comemonth"].".".$_POST["comeyear"]."  ".$_POST["comehour"].":".$_POST["comeminute"].":00\nAbreise: ".$_POST["goday"].".".$_POST["gomonth"].".".$_POST["goyear"]."  ".$_POST["gohour"].":".$_POST["gominute"].":00\nAnsprechpartner: ".$_POST["person"]."\nOrganisation: ".$_POST["organisation"]."\nTelefon: ".$_POST["phone"]."\nFax: ".$_POST["fax"]."\nMail: ".$_POST["mail"]."\nBemerkung:\n".$_POST["remark"];

      if (wp_mail("cvjmliho@web.de", "Landheimanfrage von ".$_POST["person"], strip_tags($anfrage), "From: CVJM-Lichtenhof <cvjmliho@web.de>\r\nReply-To: CVJM-Lichtenhof <cvjmliho@web.de>\r\n")) {
        print "<p>Ein Ansprechpartner im CVJM Lichtenhof wurde per Mail &uuml;ber ihre Buchungsanfrage informiert. Wir bitten um einige Tage Geduld, bis ihre Anfrage bearbeitet werden kann.";
      } else {
        print "<p>Die Mail an den CVJM Lichtenhof konnte nicht versendet werden. Bitte schreiben Sie ihre Anfrage per Mail an <a href=\"mailto:cvjmliho@web.de\">cvjmliho@web.de</a></p>";
      }

      if (wp_mail($_POST["mail"], "Best&auml;tigung Landheimanfrage", "Ihre Landheimanfrage:\n".strip_tags($anfrage)."\n\nWir bem&uuml;hen uns ihre Anfrage m&ouml;glichst schnell zu bearbeiten.\nIhr CVJM Lichtenhof", "From: CVJM-Lichtenhof <cvjmliho@web.de>\r\nReply-To: CVJM-Lichtenhof <cvjmliho@web.de>\r\n")) {
        print "<p>Sie haben eine Best&auml;tigungsmail an die von ihnen angegebe Mailadresse erhalten.";
      } else {
        print "<p>Ihre Best&auml;tigungsmail konnte nicht versendet werden.</p>";
      }

      $insdata = array('id' => '',
        'begin' => $_POST['comeyear']."-".$_POST['comemonth']."-".$_POST['comeday']."  ".$_POST['comehour'].":".$_POST['comeminute'].":00",
        'ende' => $_POST['goyear']."-".$_POST['gomonth']."-".$_POST['goday']."  ".$_POST['gohour'].":".$_POST['gominute'].":00",
        'person' => $_POST['person'],
        'organisation' => $_POST['organisation'],
        'state' => 'A',
        'phone' => $_POST['phone'],
        'fax' => $_POST['fax'],
        'give' => '',
        'take' => '',
        'mail' => $_POST['mail'],
        'remark' => $_POST['remark']
      );
      if ($db->DoInsert("landheim", $insdata) != false) {

      print "<p>Ihre Anfrage vom ".$_POST["comeday"].".".$_POST["comemonth"].".".$_POST["comeyear"]." bis zum ".$_POST["goday"].".".$_POST["gomonth"].".".$_POST["goyear"]." wurde erfolgreich eingetragen</p>";
      } else {
        print "<p>Ihre Anfrage konnte nicht eingetragen werden. Bitte schreiben Sie direkt eine Mail mit ihrer Anfrage an <a href=\"mailto:cvjmliho@web.de\">cvjmliho@web.de</a></p>";
      }

      print "<a href=\"" . get_permalink() . "\">Zur&uuml;ck zu den Belegungen</a></p>\n";
    }

  }

  if (strlen($fehlertext) != 0) {
      print "<p style=\"color:#FF0000;\"><br>Fehlerhafte Eingabe";
      print $fehlertext."<br></p>\n";
  }

  if (get_query_var('comeday') != '' || (strlen($fehlertext) != 0)) {
    $action_done = 1;
    $tmpdate = getdate(time());
    $actyear = $tmpdate["year"];
    $minutes = array(0, 15 ,30, 45);

    print "<p><br>Bitte geben Sie die n&auml;heren Informationen zu ihrer Buchung in das Formular ein.<br><br></p>\n";
    print "<form action=\"" . get_permalink() . "\" method=\"POST\">\n";
    print "<table>\n";
    print "<tr>\n";
    print "\t<td><b>Anreise:</b></td><td><select name=\"comeday\" size=\"1\">";
    for ($i=1; $i<=31; $i++) {
      if ($i == get_query_var("comeday") || 
        (array_key_exists('comeday', $_POST) && $i == $_POST["comeday"])) {
        printf ("<option selected>%02d</option>", $i);
      } else {
       printf ("<option>%02d</option>", $i);
     }
    }
    print "</select>:\n";
    print "<select name=\"comemonth\" size=\"1\">";
    for ($i=1; $i<=12; $i++) {
      if ($i == get_query_var("comemonth") || 
        (array_key_exists('comemonth', $_POST) && $i == $_POST["comemonth"])) {
        printf ("<option selected>%02d</option>", $i);
      } else {
        printf ("<option>%02d</option>", $i);
      }
    }
    print "</select>:\n";
    print "<select name=\"comeyear\" size=\"1\">";
    if (($actyear + 1) == get_query_var("comeyear") ||
      (array_key_exists('comeyear', $_POST) && ($actyear + 1) == $_POST["comeyear"])) {
      print "<option>".$actyear."</option>";
      print "<option selected>".($actyear+1)."</option>";
    } else {
      print "<option selected>".$actyear."</option>";
      print "<option>".($actyear+1)."</option>";
    }
    print "</select> - \n";
    print "<select name=\"comehour\" size=\"1\">";
    for ($i=0; $i<=23; $i++) {
      if (array_key_exists('comehour', $_POST) && $i == $_POST["comehour"]) {
        printf ("<option selected>%02d</option>", $i);
      } else {
        printf ("<option>%02d</option>", $i);
      }
    }
    print "</select>:\n";
    print "<select name=\"comeminute\" size=\"1\">";
    for ($i=0; $i<=3; $i++) {
      if (array_key_exists('comeminute', $_POST) && $minutes[$i] == $_POST["comeminute"]) {
        printf ("<option selected>%02d</option>", $minutes[$i]);
      } else {
        printf ("<option>%02d</option>", $minutes[$i]);
      }
    }
    print "</select> Uhr\n";
    print "</td>\n";
    print "</tr>\n";
    print "<tr>\n";
    print "\t<td><b>Abreise:</b></td><td><select name=\"goday\" size=\"1\">";
    for ($i=1; $i<=31; $i++) {
      if ((array_key_exists('goday', $_POST) && $i == $_POST["goday"]) ||
        get_query_var("comeday") == $i) {
        printf ("<option selected>%02d</option>", $i);
      } else {
       printf ("<option>%02d</option>", $i);
     }
    }
    print "</select>:\n";
    print "<select name=\"gomonth\" size=\"1\">";
    for ($i=1; $i<=12; $i++) {
      if ((array_key_exists('gomonth', $_POST) && $i == $_POST["gomonth"]) ||
        get_query_var("comemonth") == $i) {
        printf ("<option selected>%02d</option>", $i);
      } else {
        printf ("<option>%02d</option>", $i);
      }
    }
    print "</select>:\n";
    print "<select name=\"goyear\" size=\"1\">";
    if ((array_key_exists('goyear', $_POST) && ($actyear + 1) == $_POST["goyear"]) ||
      get_query_var("comeyear") == ($actyear + 1)) {
      print "<option>".$actyear."</option>";
      print "<option selected>".($actyear+1)."</option>";
    } else {
      print "<option selected>".$actyear."</option>";
      print "<option>".($actyear+1)."</option>";
    }
    print "</select> - \n";
    print "<select name=\"gohour\" size=\"1\">";
    for ($i=0; $i<=23; $i++) {
      if (array_key_exists('gohour', $_POST) && $i == $_POST["gohour"]) {
        printf ("<option selected>%02d</option>", $i);
      } else {
        printf ("<option>%02d</option>", $i);
      }
    }
    print "</select>:\n";
    print "<select name=\"gominute\" size=\"1\">";
    for ($i=0; $i<=3; $i++) {
      if (array_key_exists('gominute', $_POST) && $minutes[$i] == $_POST["gominute"]) {
        printf ("<option selected>%02d</option>", $minutes[$i]);
      } else {
        printf ("<option>%02d</option>", $minutes[$i]);
      }
    }
    print "</select> Uhr\n";
    print "</td>\n";
    print "</tr>\n";
    print "<tr>\n";
    print "\t<td><b>Ansprechpartner*:</b></td><td><input name=\"person\" type=\"text\" size=\"60\"";
    if (array_key_exists("person", $_POST)) {
      print "value=\"".$_POST["person"]."\"";
    }
    print "></td>\n";
    print "</tr>\n";
    print "<tr>\n";
    print "\t<td><b>Organisation</b>:</td><td><input name=\"organisation\" type=\"text\" size=\"60\"";
    if (array_key_exists("organisation", $_POST)) {
      print "value=\"".$_POST["organisation"]."\"";
    }
    print "></td>\n";
    print "</tr>\n";
    print "<tr>\n";
    print "\t<td><b>Mail*:</b></td><td><input type=\"text\" name=\"mail\" size=\"60\"";
    if (array_key_exists("mail", $_POST)) {
      print "value=\"".$_POST["mail"]."\"";
    }
    print "></td>\n";
    print "</tr>\n";
    print "<tr>\n";
    print "\t<td><b>Telefon*:</b></td><td><input type=\"text\" name=\"phone\" size=\"30\"";
    if (array_key_exists("phone", $_POST)) {
      print "value=\"".$_POST["phone"]."\"";
    }
    print "></td>\n";
    print "</tr>\n";
    print "<tr>\n";
    print "\t<td><b>Fax:</b></td><td><input type=\"text\" name=\"fax\" size=\"30\"";
    if (array_key_exists('fax', $_POST)) {
      print "value=\"".$_POST["fax"]."\"";
    }
    print "></td>\n";
    print "</tr>\n";
    print "<tr>\n";
    print "\t<td><b>Bemerkung</b><br>(z.B. Postanschrift<br>f&uuml;r Vertrag<br>wenn nicht<br>per Mail<br>gew&uuml;nscht)</td><td><textarea name=\"remark\" cols=\"30\" rows=\"6\">";
    if (array_key_exists("remark", $_POST)) {
      print htmlentities($_POST["remark"]);
    }
    print "</textarea></td>\n";
    print "</tr>\n";
    print "<tr>\n";
    print "<td>Sicherheit (bitte im Bild angezeigten Text in das Eingabefeld eingeben)</td><td>\n";
    
    echo recaptcha_get_html($publickey);

    print "</td>\n";
    print "</tr>\n";
    print "<tr>\n";
    print "\t<td>&nbsp;</td><td><input type=\"submit\" value=\"Abschicken\">&nbsp;&nbsp;\n";
    print "<a href=\"" . get_permalink() . "?belmonth=";
    if (array_key_exists("comemonth", $_POST)) {
      print $_POST["comemonth"]."&belyear=".$_POST["comeyear"];
    } else {
      print get_query_var("comemonth")."&belyear=".get_query_var("comeyear");
    }
    print "\">Buchung abbrechen</a></td>\n";
    print "</tr>\n";
    print "</table>\n";
    print "</form>\n";
  }


  if ($action_done == 0) {

  if (get_query_var('belmonth') == '') {
    $daynum = getdate(time());
    $date = mktime(0, 0, 0, $daynum["mon"], 1, $daynum["year"]);
    $daynum = getdate($date);
    $date = mktime(0, 0, 0, $daynum["mon"]+1, 0, $daynum["year"]);
  } else {
    $month = intval(get_query_var("belmonth"));
    $year = intval(get_query_var("belyear"));
    $date = mktime(0, 0, 0, $month, 1, $year);
    $daynum = getdate($date);
    $date = mktime(0, 0, 0, $month+1, 0, $year);
  }
  $tmpdate = getdate($date);
  $maxday = $tmpdate["mday"];

  print "<p align=\"center\"><br><br><table align=\"center\" class=\"contenttable-pr\" cellpadding=\"2\" border=\"0\">\n";
  print "<tr><td>\n";
  print "<table align=\"center\" border=1>\n";
  print "<tr class=\"contenttable-pr tr-0\"><td colspan=\"7\">".$monthname[$daynum["mon"] - 1]." ".$daynum["year"]."</td></tr>";
  print "<tr class=\"contenttable-pr tr-odd\"><td>Mo</td><td >Di</td><td>Mi</td>\n";
  print "<td>Do</td><td>Fr</td><td>Sa</td><td>So</td></tr>\n";

  // First week
  $weekday = $daynum["wday"];

  if ($weekday > 0) {
    $weekday--;
  } else {
    $weekday=6;
  }

  $query = "SELECT begin, ende, state FROM landheim WHERE (begin BETWEEN '".$daynum["year"]."-".$daynum["mon"]."-01 00:00:00' AND '".$daynum["year"]."-".$daynum["mon"]."-".$maxday." 23:59:59' OR ende BETWEEN '".$daynum["year"]."-".$daynum["mon"]."-01 00:00:00' AND '".$daynum["year"]."-".$daynum["mon"]."-".$maxday." 23:59:59') ORDER BY begin";

  $result = $db->DoQuery($query);

  // Fill an array which days are
  $reserved = array_fill(1, 31, 0);
  while ($line = $db->FetchAssoc($result)) {
    $anfangmon = (int)(substr($line["begin"],5,2));
    $anfangyear = (int)(substr($line["begin"],0,4));
    $anfangday = (int)(substr($line["begin"],8,2));
    $endemon = (int)(substr($line["ende"],5,2));
    $endeyear = (int)(substr($line["ende"],0,4));
    $endeday = (int)(substr($line["ende"],8,2));
    if ($anfangmon != $daynum["mon"] || $anfangyear < $daynum["year"]) {
      $startday = 1;
    } else {
      $startday = $anfangday;
    }
    if ($endemon != $daynum["mon"] || $endeyear > $daynum["year"]) {
      $endday = $maxday;
    } else {
      $endday = $endeday;
    }
    for ($i = $startday; $i<=$endday; $i++) {
      if ((strcmp(strtoupper($line["state"]), "A") == 0) && ($reserved[$i] == 0)) {
        $reserved[$i] = 2;
      } else {
        $reserved[$i] = 1;
      }
    }
  }

  print "\t<tr class=\"contenttable-pr tr-even\">\n";
  for ($i=0; $i < $weekday; $i++) {
    print "\t\t<td>&nbsp;</td>";
  }

  for ($i = 1; $i < 32 && $i <= $maxday; $i++) {
    if ($weekday == 7) {
      print "\t</tr>\n\t<tr>\n";
      $weekday = 0;
    }
    print "\t\t<td ";
    if ($reserved[$i] == 0) {
      if ($weekday == 6) {
        print "style=\"background:#85FF82;text-align:center;\"";
      } else {
        print "style=\"background:#85FF82;text-align:center;\"";
      }
      print "><a href=\"" . get_permalink() . "?comeday=$i&comemonth=".$daynum["mon"]."&comeyear=".$daynum["year"]."\">$i</a></td>\n";
    } else if ($reserved[$i] == 2) {
      if ($weekday == 6) {
        print "style=\"background:#FFB351;text-align:center;\"";
      } else {
        print "style=\"background:#FFB351;text-align:center;\"";
      }
      print "><a href=\"" . get_permalink() . "?comeday=$i&comemonth=".$daynum["mon"]."&comeyear=".$daynum["year"]."\">$i</a></td>\n";
    } else {
      if ($weekday == 6) {
        print "style=\"background:#FF7575;text-align:center;\"";
      } else {
        print "style=\"background:#FF7575;text-align:center;\"";
      }
      print ">$i</td>";
    }
    $weekday++;
  }

  if ($weekday != 7) {
    for (; $weekday < 6; $weekday++) {
      print "\t\t<td>&nbsp;</td>";
    }
    print "\t\t<td>\n\t\t&nbsp;</td>";
  }


  $db->FreeResult($result);

  print "</tr>\n";
  print "</table></td><td valign=\"center\"><h3 align=\"center\">Legende</h3>\n";
  print "<table align=\"center\"><tr><td style=\"background:#85FF82;text-align:center;\">&nbsp;</td><td>Frei</td></tr>\n";
  print "<tr><td style=\"background:#FF7575;text-align:center;\">&nbsp;</td><td>Belegt</td></tr>\n";
  print "<tr><td style=\"background:#FFB351;text-align:center;\">&nbsp;</td><td>Anfrage</td></tr>\n";
  print "</table></td></tr></table><br><br>\n";

  print "</p><p align=\"center\">\n";
  print "<a href=\"" . get_permalink() . "?belmonth=1&belyear=".($daynum["year"]-1)."\">".($daynum["year"]-1)."</a>\n";
  print "&nbsp;&nbsp;&nbsp;<<&nbsp;&nbsp;&nbsp;\n";
  for ($i=0; $i<12; $i++) {
    print "<a href=\"" . get_permalink() . "?belmonth=".($i+1)."&belyear=".$daynum["year"]."\">".$monthname[$i]."</a>\n";
    if ($i != 11) {
      print "&nbsp;-&nbsp;\n";
    }
    if ($i == 7) {
      print "<br><br>";
    }
  }
  print "&nbsp;&nbsp;&nbsp;>>&nbsp;&nbsp;&nbsp;\n";
  print "<a href=\"" . get_permalink() . "?belmonth=1&belyear=".($daynum["year"]+1)."\">".($daynum["year"]+1)."</a>\n";
  print "</p>\n";
  print "<div class=\"csc-header csc-header-n3\"><h1>Buchung</h1></div>\n";
  print "<p>Im oben angezeigten Kalender k&ouml;nnen Sie sehen, welche Tage im Landheim noch frei oder belegt sind. Gr&uuml;n angezeigte Tage sind noch frei, rot angezeigte Tage sind\n";
  print "bereits belegt, f&uuml;r orange eingef&auml;rbte Tage liegt eine Anfrage, aber noch kein unterschriebener Vertrag vor.<BR>\n";
  print "Wollen Sie selber f&uuml;r einen freien Termin eine Anfrage stellen, so klicken Sie einfach auf den entsprechenden Tag im Kalender. Im folgenden Formular geben Sie bitte ihre Daten\n";
  print" ein und Sie erhalten von uns schnellstm&ouml;glich R&uuml;ckantwort, ob der Termin in Ordnung geht oder nicht.\n";
  print "Bitte beachten Sie dabei, dass jede Anfrage von einem ehrenamtlichen Mitarbeiter von Hand bearbeitet werden muss.\n";
  print "Deshalb kann die Reaktion auf online gestellte Anfrage durchaus einige Tage dauern.<br>\n";
  print "Wird der Termin von uns best&auml;tigt, so erhalten Sie von uns einen\n";
  print "Vertrag zugeschickt, welchen Sie unterschrieben zur&uuml;cksenden m&uuml;ssen. Dann wird ihr Termin bei uns als fest gebucht eingestuft und als belegt angezeigt.</p>\n";
  }
  
  ?>
</div>

<div class="right_sidebar_container">
  <div class="association_menu" style="background-color: <?php echo $color ?>;">
    <p class="association_menu_headline"><?php echo $association_name ?></p>
    <p class="association_menu_url"><a href="http://<?php echo $association_url ?>" class="whitelink"><?php echo $association_url ?></a></p>
    <?php wp_nav_menu( array( 'theme_location' => $menu_name,
                            'container' => 'div',
                            'container_class' => 'css-treeview',
                            'walker' => new Walker_Treeview_Menu() ) ); ?>
  </div>
  <?php require(locate_template('sidebar_links.php')); ?>
</div>

<?php get_footer(); ?>
