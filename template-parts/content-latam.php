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
	</header><!-- .entry-header -->

	<div class="entry-content pb-5 container">
		<?php
		the_content();

?>

	</div><!-- .entry-content -->
	
	<?php
	//Slider
	if (is_active_sidebar('slider-liga-debate')) { ?>
		<!-- Bloque del Formulario de contacto -->
		<div>
			<?php dynamic_sidebar('slider-liga-debate'); ?>
		</div>	
	<?php 
	} 
		?>
		<div class="container">
		<?php
		//Premios
		if (rwmb_meta('league_awards') != '') {
			?>
				<h2 class="h1 heading-home heading-home--center fz-30 color-dimgray fw-300 p-4.3" style="padding-top: 5px;">Premios</h2>
				<p>UNEATLANTICO establece premios al Equipo Ganador, Equipo Finalista y Mejor Orador de Liga de Debate Preuniversitaria</p>
				<?php
				echo rwmb_meta( 'league_awards' );
		}

		if (is_active_sidebar('normativa-curso')) { ?>
			<!-- Bloque de Curso - Normativa -->
			<div>
				<?php dynamic_sidebar('normativa_curso'); ?>
			</div>	
		<?php } 

		if (is_active_sidebar('formulario-contacto-curso')) { ?>
			<!-- Bloque del Formulario de contacto -->
			<div>
				<?php dynamic_sidebar('formulario-contacto-curso'); ?>
			</div>	
		<?php } 
		?>

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'ligaDebate'),
				'after' => '</div>',
			)
		);
		?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
