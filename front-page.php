<?php
/**
 * The template for displaying Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package liga-de-debate
 */

get_header(); ?>

<?php
// dynamic_sidebar( 'home-content' );
?>


<div class="container pb-5">
  <?php 
     dynamic_sidebar( 'home-pre-content' ); 
  ?>
</div>

<div>
  <?php 
     dynamic_sidebar( 'home-banner' ); 
  ?>
</div>

<div class="">
  <?php 
     dynamic_sidebar( 'home-content' ); 
  ?>
</div>

<?php
get_footer();
