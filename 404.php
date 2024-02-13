<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package liga-de-debate
 */

get_header();
?>

	<div id="primary" class="container content-area mt-5">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title heading-home heading-home--center fz-30 color-dimgray fw-300"><?php esc_html_e( 'Lo sentimos, no se encontraron resultados', 'ligaDebate' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content text-center">
					<p><?php esc_html_e( 'Parece que no se encontró nada en esta ubicación. Tal vez intente uno de los enlaces de abajo.', 'ligaDebate' ); ?></p>

					<?php
					echo '<div class="my-4 pb-5">';
					get_search_form();
					echo '</div>';

					?>

					<?php
					/* translators: %1$s: smiley */
					$ligaDebate_archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'ligaDebate' ), convert_smilies( ':)' ) ) . '</p>';
					// the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$ligaDebate_archive_content" );

					// the_widget( 'WP_Widget_Pages' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
