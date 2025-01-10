<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package liga-de-debate
 */

?>
<article class="container" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header py-3 mt-5">
		<?php the_title('<h1 class="entry-title heading-home heading-home--center fz-30 color-dimgray fw-300">', '</h1>'); ?>
	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		// Premios
		if (rwmb_meta('league_awards') != '') {
		?>
			<div id="premios-section">
				<h2 class="mt-5 h1 heading-home heading-home--center fz-30 color-dimgray fw-300 p-4.3" style="padding-top: 5px;">Premios</h2>
				<div class="text-center">
					<p>UNEATLANTICO establece premios al Equipo Ganador, Equipo Finalista y Mejor Orador de Liga de Debate
						Preuniversitaria</p>
				</div>

				<?php
				echo rwmb_meta('league_awards');
				?>
			</div>
		<?php
		}

		if (is_active_sidebar('normativa-curso')) { ?>
			<!-- Bloque de Curso - Normativa -->
			<div>
				<?php dynamic_sidebar('normativa-curso'); ?>
			</div>
			<?php }

		// Store the current post ID
		$current_post_id = get_the_ID();

		$post_type = get_post_type(); // Get the current post type
		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => 1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		);
		$query = new WP_Query($args);

		// Check if the current post is the latest
		if ($query->have_posts()) {
			$query->the_post(); // Get the latest post
			$latest_post_id = get_the_ID(); // Store the latest post ID
			wp_reset_postdata(); // Restore original post data

			if ($current_post_id === $latest_post_id) { // Compare IDs
				if (is_active_sidebar('formulario-contacto-curso')) { ?>
					<!-- Bloque del Formulario de contacto -->
					<div>
						<?php dynamic_sidebar('formulario-contacto-curso'); ?>
					</div>
		<?php }
			}
		}
		?>


		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'ligaDebate'),
				'after' => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->