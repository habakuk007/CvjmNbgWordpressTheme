<?php /* This part of code displays the events for the theme.
       * It accepts some external variables as parameters:
       * Please include this file with
       * require(locate_template('event-box.php'));
       * You can set the following variables:
       * $event_count: Number of events to display
       * $event_vid: Veranstalter-ID used at Evangelische Termine
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
      the_widget('EvTermine_Widget', array('reqstr' => 'vid=' . $event_vid . '&itemsPerPage=' . $event_count));
    ?>
  </div>
</div>
