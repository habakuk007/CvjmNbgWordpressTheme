<?php
/*
Template Name: Verein Hauptseite
*/
get_header();

/* Save the values for our sub modules, because our page fields are gone
 * if the first sub module makes a new query */
  $parent_id = get_the_ID();
  $circle_id = get_field( 'vh_category_circles' );
  $teaser_id = get_field( 'vh_category_teaser' );
  $event_vid = get_field( 'vh_ev_vid' );
  $news_id = get_field( 'vh_category_news' );
  $association_name = get_field( 'vh_association_name' );
  $association_url = get_field( 'vh_url' );
  $menu_name = get_field( 'vh_menu' );
  $color = get_field( 'vh_color' );
?>

<?php require(locate_template('circles.php')); ?>

<div class="main_container">
  <?php require(locate_template('teaser.php')); ?>

  <?php require(locate_template('event-box.php')); ?>

  <?php require(locate_template('news-box.php')); ?>
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
