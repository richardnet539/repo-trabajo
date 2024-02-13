<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package liga-de-debate
 */

?>

<section class="no-results not-found mt-4">
	<header class="page-header">
		<h1 class="page-title heading-home heading-home--center fz-30 color-dimgray fw-300"><?php esc_html_e( 'Sin resultados', 'ligaDebate' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			printf(
				'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
					__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ligaDebate' ),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url( admin_url( 'post-new.php' ) )
			);

		elseif ( is_search() ) :
			?>
			<div class="text-center pt-4">

				<p class="pb-4"><?php esc_html_e( 'Lo sentimos, pero nada coincide con sus términos de búsqueda. Por favor, intente de nuevo con algunas palabras clave diferentes.', 'ligaDebate' ); ?></p>


					<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'Parece que no podemos encontrar lo que estás buscando. Tal vez la búsqueda puede ayudar.', 'ligaDebate' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
					
				
					


			</div>

			
			
	</div><!-- .page-content -->
</section><!-- .no-results -->
