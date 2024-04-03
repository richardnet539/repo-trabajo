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
			// zona azul
			if (is_active_sidebar('colaboradores-curso')) { ?>
				<!-- Bloque de Colaboradores -->
				<div class="pt-3" id="slider-fullwidth">
					<?php dynamic_sidebar('colaboradores-curso'); ?>
				</div>	
			<?php }
			?>
		</div>
		<div class="container">
			<?php
				if (is_active_sidebar('programa-curso')) { ?>
					<!-- Bloque del Programa -->
					<div class="pt-3">
						<?php dynamic_sidebar('programa-curso'); ?>
					</div>	
				<?php }

				if (is_active_sidebar('formulario-contacto-curso')) { ?>
				<!-- Bloque de Formulario de contacto -->
				<div class="pt-3">
					<?php dynamic_sidebar('formulario-contacto-curso'); ?>
				</div>	
			<?php }
			?>
		</div>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
