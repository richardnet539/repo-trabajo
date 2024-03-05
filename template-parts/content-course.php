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
		$showThumbnail = get_the_post_thumbnail('184', 'page-thumbnail', ['class' => 'feature-heading__img img-fluid']);
		echo get_the_post_thumbnail('184', 'page-thumbnail', ['class' => 'feature-heading__img img-fluid']);
		?>
	</div>

	<header class="entry-header py-3">
		<?php the_title('<h2 class="entry-title heading-home heading-home--center fz-30 color-dimgray fw-300">', '</h2>'); ?>
	</header><!-- .entry-header -->



	<div class="entry-content pb-5">


		<?php
		the_content();
		
		// zona azul
		if (is_active_sidebar('colaboradores-curso')) { ?>
			<!-- Bloque de Colaboradores -->
			<div class="bg-light-blue">
				<?php dynamic_sidebar('colaboradores-curso'); ?>
			</div>	
		<?php }
		

		if (is_active_sidebar('programa-curso')) { ?>
			<!-- Bloque del Programa -->
			<div class="">
				<?php dynamic_sidebar('programa-curso'); ?>
			</div>	
		<?php }
		

		// zona azul
		if (is_active_sidebar('formulario-contacto-curso')) { ?>
			<!-- Bloque de Curso - Normativa -->
			<div class="">
				<?php dynamic_sidebar('formulario-contacto-curso'); ?>
			</div>	
		<?php }
		?>


		<script>
			const gallery = document.getElementsByClassName('wp-block-gallery');
			const modal = document.getElementById("modal-slider");
			const arr = [...gallery[0].children];
			arr.forEach((element, index) => {
				element.children[0].addEventListener("click", e => {
					const imageElement = document.getElementById('modal-slider-image');

					imageElement.src = element.children[0].currentSrc;
					modal.style.display = "flex";

				});
			});
			window.onclick = function (event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
		</script>


		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'residencia'),
				'after' => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

		<h1>estamos en content-course</h1>

	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
