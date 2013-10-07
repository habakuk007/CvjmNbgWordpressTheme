<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage CVJM_Nuernberg
 * @since CVJM_Nuernberg 1.0
 */
?>

<?php wp_nav_menu( array( 'theme_location' => 'footer-menu',
                            'container_class' => 'footercontainer',
                            'walker' =>  new Footer_Menu_Walker() ) ); ?>

<?php wp_footer(); ?>
</body>
</html>
