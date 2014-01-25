<?php /* This part of code displays the events for the theme.
       * It accepts some external variables as parameters:
       * Please include this file with
       * require(locate_template('event-box.php'));
       * You can set the following variables:
       * $event_count: Number of events to display
       * $event_vid: Veranstalter-ID used at Evangelische Termine
       * $event_add_query: Additional query options
	   * $event_show_filter: true show lamp, else show not
       **/
?>
<div class="eventbox">
  <div class="event_headline_container">
  <?php
    if (isset($event_show_filter))
	{
      if (strcmp(get_query_var('evterm_hilight'), 'off')  == 0)
      {
        echo '<a href="' . home_url(add_query_arg('evterm_hilight' , 'on')) . '">' . "\n";
	    echo '<img src="';
        echo get_stylesheet_directory_uri();
	    echo '/images/highlight_off.png" alt="Nur Highlights zeigen" class="evterm_hilight_image" />' . "\n";
	    echo '</a>' . "\n";
	  } else {
	    echo '<a href="';
        echo add_query_arg('evterm_hilight' , 'off');
        echo '">' . "\n";
	    echo '<img src="';
        echo get_stylesheet_directory_uri();
	    echo '/images/highlight_on.png" alt="Nur Highlights zeigen"  class="evterm_hilight_image" />' . "\n";
	    echo '</a>' . "\n";
		if (isset($event_add_query) && strlen($event_add_query) > 0) {
		  $event_add_query .= '&highlight=high';
		} else {
		  $event_add_query = 'highlight=high';
		}
	  }
	}
  ?>
  <h1 class="event_headline">N&auml;chste Termine</h1>
  </div>
  <div class="partseperator"></div>
  <div class="event_list">
    <?php
      if (!isset($event_count)) {
        $event_count = 5;
      }
      if (!isset($event_vid)) {
        $event_vid = 1498;
      }
      $query_string = 'vid=' . $event_vid . '&itemsPerPage=' . $event_count;
      if (isset($event_add_query) && strlen($event_add_query) > 0) {
        $query_string .= '&' . $event_add_query;
      }
      the_widget('EvTermine_Widget', array('reqstr' => $query_string));
    ?>
  </div>
</div>
