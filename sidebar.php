<div class="right_sidebar_container">
  <div class="first_contact_container">
    <img src="<?php bloginfo('template_directory'); ?>/images/first_contact_logo.jpg" class="sidebar_header_image">
    <form action="<?php echo esc_url( get_permalink( get_page_by_title( 'First-Contact-Antwort' ) ) ); ?>" method="POST">
      <input name="first_contact_mail" type="text" class="first_contact_text_input" placeholder="E-Mail Adresse">
      <input name="first_contact_name" type="text" class="first_contact_text_input" placeholder="Name">
      <input name="first_contact_age" type="text" class="first_contact_text_input" placeholder="Alter">
      <textarea name="first_contact_issue" class="first_contact_text_input" rows="4" placeholder="Anliegen"></textarea>
      <input type="submit" value="abschicken" class="first_contact_submit">
    </form>
  </div>
  <div class="map_container">
    <img src="<?php bloginfo('template_directory'); ?>/images/CVJM_Vereine_Nuernberg_Karte.jpg" width="600" height="450" class="map_image" usemap="#citymap" />
	<map name="citymap" id="citymap">
	  <area shape="rect" title="Gro&szlig;gr&uuml;ndlach" coords="182,56,234,103" href="<?php echo esc_url( get_permalink( get_page_by_title( 'CVJM Großgründlach' ) ) ); ?>"  />
      <area shape="rect" title="Kornmarkt" coords="270,178,326,229" href="<?php echo esc_url( get_permalink( get_page_by_title( 'CVJM Kornmarkt' ) ) ); ?>" />
      <area shape="rect" title="Gostenhof" coords="242,238,294,285" href="<?php echo esc_url( get_permalink( get_page_by_title( 'CVJM Gostenhof' ) ) ); ?>" />
      <area shape="rect" title="Lichtenhof" coords="300,249,352,296" href="<?php echo esc_url( get_permalink( get_page_by_title( 'CVJM Lichtenhof' ) ) ); ?>" />
    </map>
    <!--<iframe width="100%" height="260" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.de/maps/ms?msa=0&amp;msid=202299304858622703127.0004eca77fc359d632122&amp;ie=UTF8&amp;t=m&amp;ll=49.430626,11.074905&amp;spn=0.116109,0.179214&amp;z=11&amp;output=embed"></iframe>-->
  </div>
  <div class="losung_title_image_container">
    <a href="http://www.grasundufer.de/index.php?view=newsfeed&catid=46%3Achristliche-feeds&id=16-erfde-worte-zur-losung&option=com_newsfeeds&Itemid=104" target="_blank">
    <img src="<?php bloginfo('template_directory'); ?>/images/tageslosung_logo.jpg" class="sidebar_header_image">
    </a>
    <?php the_widget('Losung_Widget', ''); ?>
  </div>
  <?php require(locate_template('sidebar_links.php')); ?>
</div>