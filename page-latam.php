<?php
/**
 * Template Name: Page Latam
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package liga-de-debate
 */

get_header();
?>
<div class="container">
<div class="row">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content-page', 'latam' );





			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		</main><!-- #main -->
	</div><!-- #primary -->
</div>
<h1>Page LATAM</h1>
</div>

<?php
get_footer();
