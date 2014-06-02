<?php
/*
Template Name: Verein Freiseite
*/
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
    wp_reset_query();
    echo apply_filters('the_content', $post->post_content);
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
