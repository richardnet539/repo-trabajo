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
		<main id="main" class="site-main">
		<h1></h1>
		<?php
			while(have_posts()):
				the_post();
				get_template_part('template-parts/content', 'course');
			endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	</div>
	<h1>estamos en single course</h1>
</div>
<?php
get_footer();
