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
		if (is_active_sidebar('slider-liga-debate')) { ?>
			<!-- Bloque del Formulario de contacto -->
			<div id="slider-fullwidth" class="bg-light-blue mt-5">
				<?php dynamic_sidebar('slider-liga-debate'); ?>
			</div>	
		<?php 
		} 

		if (is_active_sidebar('normativa-curso')) { ?>
			<!-- Bloque de Curso - Normativa -->
			<div>
				<?php dynamic_sidebar('normativa-curso'); ?>
			</div>
		<?php } 

		if (is_active_sidebar('formulario-contacto-curso')) { ?>
			<!-- Bloque del Formulario de contacto -->
			<div>
				<?php dynamic_sidebar('formulario-contacto-curso'); ?>
			</div>	
		<?php 
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
