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
	<div class="entry-content pb-5">
		<?php
		the_content();
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

	<div>
		<?php
		// Store the current post ID
		$current_post_id = get_the_ID();

		// Check if the current post is the latest in its custom post type
		$post_type = get_post_type(); // Get the current post type
		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => 1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		);
		$query = new WP_Query($args);

		if ($query->have_posts()) {
			$query->the_post(); // Get the latest post
			$latest_post_id = get_the_ID(); // Store the latest post ID
			wp_reset_postdata(); // Restore original post data

			// Compare current post ID with the latest post ID
			if ($current_post_id === $latest_post_id) { 
				if (is_active_sidebar('formulario-contacto-curso')) { ?>
					<!-- Bloque de Formulario de contacto -->
					<div class="pt-3">
						<?php dynamic_sidebar('formulario-contacto-curso'); ?>
					</div>
				<?php }
			}
		}
		?>
		<div class="container-courses-webforms">
			<?php
			dynamic_sidebar('webforms-course');
			?>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
