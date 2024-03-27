<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package liga-de-debate
 */

get_header();
?>
<div class="container">
<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php
			while(have_posts()):
				the_post();
				get_template_part('template-parts/content', 'spain');
			endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	</div>
</div>

<?php
if (is_active_sidebar('normativa-curso')) { ?>
	<!-- Bloque de Curso - Normativa -->
	<div>
		<?php dynamic_sidebar('normativa-curso'); ?>
	</div>
<?php } 
?>
get_footer();
