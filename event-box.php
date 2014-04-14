<?php /* This part of code displays the events for the theme.
       * It accepts some external variables as parameters:
       * Please include this file with
       * require(locate_template('event-box.php'));
       * You can set the following variables:
       * $event_count: Number of events to display
       * $event_vid: Veranstalter-ID used at Evangelische Termine
       * $event_add_query: Additional query options
	   * $event_show_filter: array with the following keys
	       highlight: Show highlight lamp
		   noheadline: do not show headline   
       **/
?>
<div class="eventbox">
  <div class="event_headline_container">
  <?php
    if (!isset($event_count)) {
      $event_count = 7;
    }
    if (!isset($event_vid)) {
      $event_vid = 1498;
    }
    if (!isset($event_show_filter)) {
      $event_show_filter = array( 'highlight' => 'no', 'noheadline' => 'no' );
    }
	
	if (array_key_exists('noheadline', $event_show_filter) && strcmp($event_show_filter['noheadline'], 'yes') == 0)
	{
	  echo '</div>' . "\n";
	} else {
	  echo '<h1 class="event_headline">N&auml;chste Termine</h1>' . "\n";
	  echo '</div>' . "\n";
	  echo '<div class="partseperator"></div>' . "\n";
	}
  ?>
  <div class="event_list">
    <?php
      $query_string = 'vid=' . $event_vid . '&itemsPerPage=' . $event_count;
      if (isset($event_add_query) && strlen($event_add_query) > 0) {
        $query_string .= '&' . $event_add_query;
      }
      the_widget('EvTermine_Widget', array('reqstr' => $query_string, 'filter' => $event_show_filter));
    ?>
  </div>
</div>
