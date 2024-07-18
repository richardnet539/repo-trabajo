<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package liga-de-debate
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="feature-heading mb-5">
		<?php
		the_post_thumbnail( 'page-thumbnail', array(
			'alt' => the_title_attribute( array(
				'echo' => false,
			) ),
			'class' => 'feature-heading__img img-fluid',
		) );
		?>
		<div class="feature-heading__text">
			<?php
			if (rwmb_meta('league_awards') != '') {
				echo rwmb_meta( 'league_awards' );
			}
			?>
		</div>
	</div>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title heading-home heading-home--center fz-30 color-dimgray fw-300">', '</h1>' ); ?>
	</header><!-- .entry-header -->


	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ligaDebate' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'ligaDebate' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
