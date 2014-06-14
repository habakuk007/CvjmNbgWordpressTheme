<?php
require(locate_template('/home/cvjmweb/database_landheim.inc'));

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
    if (is_user_logged_in()) {
      $db = new Landheim_Database;
      $db->OpenDatabase();

      if (strcmp(get_query_var('belaction'), 'del') == 0) {
        print "<p>Diesen Eintrag wirklich l&ouml;schen?</p>";
        print "<table border=\"0\" width=\"70%\"><tr>\n";
        print "<td><a href=\"" . get_permalink() . "?belaction=dodel&belentry=" . get_query_var('belentry') . "&belmonth=" . get_query_var('belmonth') . "&belyear=" . get_query_var('belyear') . "\">JAAA!</a></td>\n";
        print "<td><a href=\"" . get_permalink() . "?belmonth=" . get_query_var('belmonth') . "&belyear=" . get_query_var('belyear') . "\">NEIN</a></td>\n";
        print "</tr></table>\n";
      } else if (strcmp(get_query_var('belaction'), "new") == 0) {
        $daynum = getdate(time());

        print "<form action=\"" . get_permalink() . "?belaction=donew&belmonth=" . get_query_var('belmonth') . "&elyear=" . get_query_var('belyear') . "\" method=\"POST\">\n";
        print "<table class=\"contenttable-pr\" border=\"1\" width=\"90%\">\n";
        print "<tr class=\"contenttable-pr tr-odd\">\n";
        print "\t<td><b>Anreise:</b></td><td><select name=\"comeday\" size=\"1\">";
        for ($i=1; $i<=31; $i++) {
            printf ("<option>%02d</option>", $i);
        }
        print "</select>:\n";
        print "<select name=\"comemonth\" size=\"1\">";
        for ($i=1; $i<=12; $i++) {
          printf ("<option>%02d</option>", $i);
        }
        print "</select>:\n";
        print "<select name=\"comeyear\" size=\"1\">";
        print "<option>".$daynum["year"]."</option>";
        print "<option>".($daynum["year"]+1)."</option>";
        print "</select> - \n";
        print "<select name=\"comehour\" size=\"1\">";
        for ($i=0; $i<=23; $i++) {
          printf ("<option>%02d</option>", $i);
        }
        print "</select>:\n";
        print "<select name=\"comeminute\" size=\"1\">";
        $times = array(0, 15, 45, 30);
        for ($i=0; $i<4; $i++) {
          printf ("<option>%02d</option>", $times[$i]);
        }
        print "</select> Uhr\n";
        print "</td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-even\">\n";
        print "\t<td><b>Abreise:</b></td><td><select name=\"goday\" size=\"1\">";
        for ($i=1; $i<=31; $i++) {
         printf ("<option>%02d</option>", $i);
        }
        print "</select>\n";
        print "<select name=\"gomonth\" size=\"1\">";
        for ($i=1; $i<=12; $i++) {
         printf ("<option>%02d</option>", $i);
        }
        print "</select>\n";
        print "<select name=\"goyear\" size=\"1\">";
        print "<option selected>".$daynum["year"]."</option>";
        print "<option>".($daynum["year"]+1)."</option>";
        print "</select> - \n";
        print "<select name=\"gohour\" size=\"1\">";
        for ($i=0; $i<=23; $i++) {
          printf ("<option>%02d</option>", $i);
        }
        print "</select>:\n";
        print "<select name=\"gominute\" size=\"1\">";
        for ($i=0; $i<4; $i++) {
          printf ("<option>%02d</option>", $times[$i]);
        }
        print "</select> Uhr\n";
        print "</td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-odd\">\n";
        print "\t<td><b>Ansprechpartner*:</b></td><td><input name=\"person\" type=\"text\" size=\"60\"></td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-even\">\n";
        print "\t<td><b>Organisation</b>:</td><td><input name=\"organisation\" type=\"text\" size=\"60\"></td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-odd\">\n";
        print "<td><b>Mail*:</b></td><td><input type=\"text\" name=\"mail\" size=\"60\"></td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-even\">\n";
        print "<td><b>Telefon*:</b></td><td><input type=\"text\" name=\"phone\" size=\"30\"></td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-odd\">\n";
        print "<td><b>Fax:</b></td><td><input type=\"text\" name=\"fax\" size=\"30\"></td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-even\">\n";
        print "\t<td><b>Bemerkung</b></td><td><textarea name=\"remark\" cols=\"30\" rows=\"6\">";
        print "</textarea></td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-odd\">\n";
        print "<td><b>Status:</b></td><td><input type=\"text\" name=\"state\" size=\"1\">A=Anfrage, G= Gebucht</td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-even\">\n";
        print "<td><b>&Uuml;bergabe:</b></td><td><input type=\"text\" name=\"give\" size=\"30\"></td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-odd\">\n";
        print "<td><b>Abnahme:</b></td><td><input type=\"text\" name=\"take\" size=\"30\"></td>\n";
        print "</tr>\n";
        print "<tr class=\"contenttable-pr tr-even\">\n";
        print "<td>&nbsp;</td><td><input type=\"submit\" value=\"Anlegen\">\n";
        print "<a href=\"" . get_permalink() . "?belmonth=" . get_query_var('belmonth') . "&belyear=" . get_query_var('belyear') . "\">Zur&uuml;ck zu den Landheimbelegungen</a>";
        print "</td>\n";
        print "</tr>\n";
        print "</table>\n";
        print "</form>\n";


      } else if (strcmp(get_query_var('belaction'), "edit") == 0) {
        if ($result = $db->DoQuery("SELECT begin, ende, person, organisation, state, phone, fax, give, take, mail, remark FROM landheim WHERE id=".get_query_var('belentry'))) {
          if ($line = $db->FetchAssoc($result)) {
            $anfangmon = (int)(substr($line["begin"],5,2));
            $anfangyear = (int)(substr($line["begin"],0,4));
            $anfangday = (int)(substr($line["begin"],8,2));
            $anfanghour = (int)(substr($line["begin"], 11, 2));
            $anfangminute = (int)(substr($line["begin"], 14, 2));
            $endemon = (int)(substr($line["ende"],5,2));
            $endeyear = (int)(substr($line["ende"],0,4));
            $endeday = (int)(substr($line["ende"],8,2));
            $endehour = (int)(substr($line["ende"], 11, 2));
            $endeminute = (int)(substr($line["ende"], 14, 2));
            print "<form action=\"" . get_permalink() . "?belaction=doedit&belmonth=" . get_query_var('belmonth') . "&belyear=" . get_query_var('belyear') . "\" method=\"POST\">\n";
            print "<input type=\"hidden\" name=\"entry\" value=\"" . get_query_var('belentry') . "\">";
            print "<table class=\"contenttable-pr\" border=\"1\">\n";
            print "<tr class=\"contenttable-pr tr-odd\">\n";
            print "\t<td><b>Anreise:</b></td><td><select name=\"comeday\" size=\"1\">";
            for ($i=1; $i<=31; $i++) {
              if ($i == $anfangday) {
              printf ("<option selected>%02d</option>", $i);
            } else {
             printf ("<option>%02d</option>", $i);
           }
          }
          print "</select>:\n";
          print "<select name=\"comemonth\" size=\"1\">";
          for ($i=1; $i<=12; $i++) {
            if ($i == $anfangmon) {
              printf ("<option selected>%02d</option>", $i);
            } else {
              printf ("<option>%02d</option>", $i);
            }
          }
          print "</select>:\n";
          print "<select name=\"comeyear\" size=\"1\">";
          print "<option>".$anfangyear."</option>";
          print "<option>".($anfangyear+1)."</option>";
          print "</select> - \n";
          print "<select name=\"comehour\" size=\"1\">";
          for ($i=0; $i<=23; $i++) {
            if ($i == $anfanghour) {
              printf ("<option selected>%02d</option>", $i);
            } else {
              printf ("<option>%02d</option>", $i);
            }
          }
          print "</select>:\n";
          print "<select name=\"comeminute\" size=\"1\">";
          $times = array(0, 15, 45, 30);
          for ($i=0; $i<4; $i++) {
            if ($anfangminute == $times[$i]) {
              printf ("<option>%02d</option>", $times[$i]);
            } else {
              printf ("<option>%02d</option>", $times[$i]);
            }
          }
          print "</select> Uhr\n";
          print "</td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-even\">\n";
          print "\t<td><b>Abreise:</b></td><td><select name=\"goday\" size=\"1\">";
          for ($i=1; $i<=31; $i++) {
             if ($i == $endeday) {
              printf ("<option selected>%02d</option>", $i);
            } else {
             printf ("<option>%02d</option>", $i);
           }
          }
          print "</select>\n";
          print "<select name=\"gomonth\" size=\"1\">";
          for ($i=1; $i<=12; $i++) {
             if ($i == $endemon) {
              printf ("<option selected>%02d</option>", $i);
            } else {
             printf ("<option>%02d</option>", $i);
           }
          }
          print "</select>\n";
          print "<select name=\"goyear\" size=\"1\">";
          print "<option selected>".$endeyear."</option>";
          print "<option>".($endeyear+1)."</option>";
          print "</select> - \n";
          print "<select name=\"gohour\" size=\"1\">";
          for ($i=1; $i<=23; $i++) {
           if ($i == $endehour) {
              printf ("<option selected>%02d</option>", $i);
            } else {
              printf ("<option>%02d</option>", $i);
            }
          }
          print "</select>:\n";
          print "<select name=\"gominute\" size=\"1\">";
          for ($i=0; $i<4; $i++) {
            if ($endeminute == $times[$i]) {
              printf ("<option>%02d</option>", $times[$i]);
            } else {
              printf ("<option>%02d</option>", $times[$i]);
            }
          }
          print "</select> Uhr\n";
          print "</td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-odd\">\n";
          print "\t<td><b>Ansprechpartner*:</b></td><td><input name=\"person\" type=\"text\" size=\"60\" value=\"".$line["person"]."\"></td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-even\">\n";
          print "\t<td><b>Organisation</b>:</td><td><input name=\"organisation\" type=\"text\" size=\"60\" value=\"".$line["organisation"]."\"></td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-odd\">\n";
          print "<td><b>Mail*:</b></td><td><input type=\"text\" name=\"mail\" size=\"60\" value=\"".$line["mail"]."\"></td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-even\">\n";
          print "<td><b>Telefon*:</b></td><td><input type=\"text\" name=\"phone\" size=\"30\" value=\"".$line["phone"]."\"></td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-odd\">\n";
          print "<td><b>Fax:</b></td><td><input type=\"text\" name=\"fax\" size=\"30\" value=\"".$line["fax"]."\"></td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-even\">\n";
          print "\t<td><b>Bemerkung</b></td><td><textarea name=\"remark\" cols=\"30\" rows=\"6\">";
          print htmlentities($line["remark"]);
          print "</textarea></td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-odd\">\n";
          print "<td><b>Status:</b></td><td><input type=\"text\" name=\"state\" size=\"1\" value=\"".$line["state"]."\">A=Anfrage, G= Gebucht</td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-even\">\n";
          print "<td><b>&Uuml;bergabe:</b></td><td><input type=\"text\" name=\"give\" size=\"30\" value=\"".$line["give"]."\"></td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-odd\">\n";
          print "<td><b>Abnahme:</b></td><td><input type=\"text\" name=\"take\" size=\"30\" value=\"".$line["take"]."\"></td>\n";
          print "</tr>\n";
          print "<tr class=\"contenttable-pr tr-even\">\n";
          print "<td>&nbsp;</td><td><input type=\"submit\" value=\"&Auml;ndern\">&nbsp;&nbsp;\n";
          print "<a href=\"" . get_permalink() . "?belmonth=$anfangmon&belyear=$anfangyear\">Zur&uuml;ck zur &Uuml;bersicht</a></td>\n";
          print "</tr>\n";
          print "</table>\n";
          print "</form>\n";
          }
          $db->FreeResult($result);
        }


      } else {

        if (strcmp(get_query_var('belaction'), "dodel") == 0) {
          if ($result = $db->DoQuery("DELETE FROM landheim WHERE id='" . get_query_var('belentry') . "'")) {
            print "<p>Die Landheimbelegung wurde erfolgreich aus der Datenbank gel&ouml;scht</p>";
          } else {
            print "<p>Die Landheimbelegung wurde NICHT aus der Datenbank gel&ouml;scht</p>";
          }
        }

        if (strcmp(get_query_var('belaction'), "donew") == 0) {
          if ($db->DoQuery("INSERT INTO landheim (id, begin, ende, person, organisation, state, phone, fax, give, take, mail, remark) VALUES('', '".$_POST["comeyear"]."-".$_POST["comemonth"]."-".$_POST["comeday"]."  ".$_POST["comehour"].":".$_POST["comeminute"].":00', '".$_POST["goyear"]."-".$_POST["gomonth"]."-".$_POST["goday"]."  ".$_POST["gohour"].":".$_POST["gominute"].":00', '".$_POST["person"]."', '".$_POST["organisation"]."', '".$_POST["state"]."', '".$_POST["phone"]."', '".$_POST["fax"]."', '".$_POST["give"]."', '".$_POST["take"]."', '".$_POST["mail"]."', '".$_POST["remark"]."')")) {
            print "<p>Eintrag wurde angelegt</p>";
          } else {
            print "<p>Eintrag wurde nicht angelegt</p>";
          }
        }

        if (strcmp(get_query_var('belaction'), "doedit") == 0) {
          if ($db->DoQuery("UPDATE landheim SET begin='".$_POST["comeyear"]."-".$_POST["comemonth"]."-".$_POST["comeday"]."  ".$_POST["comehour"].":".$_POST["comeminute"].":00', ende='".$_POST["goyear"]."-".$_POST["gomonth"]."-".$_POST["goday"]."  ".$_POST["gohour"].":".$_POST["gominute"].":00', person='".$_POST["person"]."', organisation='".$_POST["organisation"]."', state='".$_POST["state"]."', phone='".$_POST["phone"]."', fax='".$_POST["fax"]."', give='".$_POST["give"]."', take='".$_POST["take"]."', mail='".$_POST["mail"]."', remark='".$_POST["remark"]."' WHERE id='".$_POST["entry"]."'")) {
            print "<p>Eintrag wurde ge&auml;ndert</p>";
          } else {
            print "<p>Eintrag wurde nicht ge&auml;ndert</p>";
          }
        }

        $monthname = array("Januar", "Februar", "M&auml;rz", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
        $month = get_query_var('belmonth');
        $year = get_query_var('belyear');
        
        if ($month == "") {
          $daynum = getdate(time());
          $date = mktime(0, 0, 0, $daynum["mon"], 1, $daynum["year"]);
          $daynum = getdate($date);
          $date = mktime(0, 0, 0, $daynum["mon"]+1, 0, $daynum["year"]);
        } else {
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
        
        $query = "SELECT id, begin, ende, person, organisation, phone, fax, mail, state, give, take, remark FROM landheim WHERE (begin BETWEEN '".$daynum["year"]."-".$daynum["mon"]."-01 00:00:00' AND '".$daynum["year"]."-".$daynum["mon"]."-".$maxday." 23:59:59' OR ende BETWEEN '".$daynum["year"]."-".$daynum["mon"]."-01 00:00:00' AND '".$daynum["year"]."-".$daynum["mon"]."-".$maxday." 23:59:59') ORDER BY begin";
        
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
            print ">$i</td>\n";
          } else if ($reserved[$i] == 2) {
            if ($weekday == 6) {
              print "style=\"background:#FFB351;text-align:center;\"";
            } else {
              print "style=\"background:#FFB351;text-align:center;\"";
            }
            print ">$i</td>\n";
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
        
        print "<p><br><a href=\"" . get_permalink() . "?belaction=new&belmonth".$daynum["mon"]."&belyear=".$daynum["year"]."\">Neuen Eintrag anlegen</a><br><br></p>\n";

         if ($db->rewind_data($result)) {
          print "<table width=\"90%\" border=\"1\" class=\"contenttable-pr\">\n";
          print "<tr class=\"contenttable-pr tr-0\"><td>Ankunft</td><td>Abreise</td><td>Ansprechpartner</td><td>Organisation</td>";
          /*print "<td>Telefon</td><td>Fax</td><td>Mail</td>";*/
          print "<td>Status</td>";
          /*print "<td>&Uuml;bergabe</td><td>Abnahme</td>\n";*/
          print "<td>Bemerkung</td><td>Edit</td></tr>\n";
          $odd = 0;
          while ($line = $db->FetchAssoc($result)) {
            $anfangmon = (int)(substr($line["begin"],5,2));
            $anfangyear = (int)(substr($line["begin"],0,4));
            $anfangday = (int)(substr($line["begin"],8,2));
            $endemon = (int)(substr($line["ende"],5,2));
            $endeyear = (int)(substr($line["ende"],0,4));
            $endeday = (int)(substr($line["ende"],8,2));
            print "<tr ";
            if ($odd == 0) {
          print("class=\"contenttable-pr tr-odd\"");
          $odd = 1;
            } else {
          print("class=\"contenttable-pr tr-even\"");
          $odd = 0;
            }
            print">\n";
            print "<td><b>$anfangday.$anfangmon.$anfangyear</b></td>\n";
            print "<td><b>$endeday.$endemon.$endeyear</b></td>\n";
            print "<td>".$line["person"]."</td>\n";
            print "<td>".$line["organisation"]."</td>\n";
            /*print "<td>".$line["phone"]."</td>\n";
            print "<td>".$line["fax"]."</td>\n";
            print "<td>".$line["mail"]."</td>\n";*/
            print "<td>".$line["state"]."</td>\n";
            /*print "<td>".$line["give"]."</td>\n";
            print "<td>".$line["take"]."</td>\n";*/
            print "<td>".$line["remark"]."</td>\n";
            print "<td><a href=\"" . get_permalink() . "?belaction=edit&belentry=".$line["id"]."&belmonth=".$anfangmon."&belyear=".$anfangyear."\">Edit/Details</a><br>";
            print "<a href=\"" . get_permalink() . "?belaction=del&belentry=".$line["id"]."&belmonth=".$anfangmon."&belyear=".$anfangyear."\">L&ouml;schen</a></td>\n";
            print "</tr>\n";
          }
          print "</table>\n";
        } else {
          print ("<p>Fehler beim zur&uuml;ckspulen der Daten</p>");
        }
        $db->FreeResult($result);
      }
    } else {
      echo '<p>Sorry! Dies ist eine Seite nur f&uuml;r angemeldete Benutzer!</p>' ."\n";
      echo '<a href="' . wp_login_url( get_permalink() ) . '" title="Login">Zum Login...</a>' . "\n";
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
