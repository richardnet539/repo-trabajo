<?php
/**
 * Template Name: Page University
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package liga-de-debate
 */

get_header();
?>
<div class="container">
<div class="row">
	<div id="primary" class="content-area <?php echo ligaDebate_main_content_bootstrap_classes(); ?>">
		<main id="main" class="site-main">
		<h1>Estamos en page</h1>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-page', 'university' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
<h1>Fin de page</h1>
		</main><!-- #main -->
	</div><!-- #primary -->
	<?php
	get_sidebar();
	?>
</div>
</div>
<?php
get_footer();
