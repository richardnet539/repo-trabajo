<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package liga-de-debate
 */

get_header();
?>

	<section id="primary" class="container content-area my-5">
		<main id="main" class="site-main pb-5">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title heading-home heading-home--center fz-30 color-dimgray fw-300">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Resultados para: %s', 'ligaDebate' ), '<span class="color-gray fw-300">' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
// get_sidebar();
get_footer();
