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
	<header class="entry-header py-3">
		<?php the_title('<h2 class="entry-title heading-home heading-home--center fz-30 color-dimgray fw-300">', '</h2>'); ?>
	</header><!-- .entry-header -->
	<div class="entry-content container pb-5">
		<?php
		the_content();
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
		<div class="content">
			<?php
			// zona azul
			if (is_active_sidebar('colaboradores-curso')) { ?>
				<!-- Bloque de Colaboradores -->
				<div class="bg-light-blue pt-3">
					<?php dynamic_sidebar('colaboradores-curso'); ?>
				</div>	
			<?php }
			

			if (is_active_sidebar('programa-curso')) { ?>
				<!-- Bloque del Programa -->
				<div class="pt-3 container">
					<?php dynamic_sidebar('programa-curso'); ?>
				</div>	
			<?php }
			

			// zona azul
			if (is_active_sidebar('formulario-contacto-curso')) { ?>
				<!-- Bloque de Curso - Normativa -->
				<div class="pt-3">
					<?php dynamic_sidebar('formulario-contacto-curso'); ?>
				</div>	
			<?php }
			?>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
