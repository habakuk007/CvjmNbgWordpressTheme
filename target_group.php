<?php
/*
Template Name: Zielgruppe
*/
get_header(); ?>

<div class="target_group_headline_container">
  <span class="target_group_headline"><?php the_title()?></span>
  <img src="<?php the_field( 'circle_picture' )?>" class="target_group_circle_image" />
</div>

<div class="target_group_desc_container">
  <div class="target_group_desc_col">
    <h1 class="target_group_desc_headline"><?php the_field( 'title_first_col' ) ?></h1>
    <p class="target_group_desc_body"><?php the_field( 'content_first_col' ) ?></p>
  </div>
  <div class="target_group_desc_col">
    <h1 class="target_group_desc_headline"><?php the_field( 'title_second_col' ) ?></h1>
    <p class="target_group_desc_body"><?php the_field( 'content_second_col' ) ?></p>
  </div>
  <div class="target_group_desc_col">
    <h1 class="target_group_desc_headline"><?php the_field( 'title_third_col' ) ?></h1>
    <p class="target_group_desc_body"><?php the_field( 'content_third_col' ) ?></p>
  </div>
</div>

<div class="target_group_contact_container">
</div>

<?php get_footer(); ?>
