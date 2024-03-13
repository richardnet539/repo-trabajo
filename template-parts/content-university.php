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
		//Slider
		if (rwmb_meta('slider_photos') != '') {
			echo rwmb_meta( 'slider_photos' );
		}
		?>

		//Premios
		if (rwmb_meta('league_awards') != '') {
			?>
			<h2 class="h1 heading-home heading-home--center fz-30 color-dimgray fw-300 p-4.3" style="padding-top: 5px;">Premios</h2>
			<div class="text-center">
				<p>UNEATLANTICO establece premios al Equipo Ganador, Equipo Finalista y Mejor Orador de Liga de Debate
					Preuniversitaria</p>
			</div>

			<?php
			echo rwmb_meta('league_awards');
		}
		?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'residencia'),
				'after' => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
