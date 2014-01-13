<?php /* This part of code displays the events for the theme.
       * It accepts some external variables as parameters:
       * Please include this file with
       * require(locate_template('event-box.php'));
       * You can set the following variables:
       * $event_count: Number of events to display
       * $event_vid: Veranstalter-ID used at Evangelische Termine
       * $event_add_query: Additional query options
       **/
?>
<div class="eventbox">
  <h1 class="event_headline">N&auml;chste Termine</h1>
  <hr class="partseperator">
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
