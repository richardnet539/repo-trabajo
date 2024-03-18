<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package liga-de-debate
 */

?>
<?php
global $paged;
$curpage = $paged ? $paged : 1;
$args = array(
	'orderby' => 'post_date',
	'posts_per_page' => 4,
	'paged' => $paged,
	'post_type' => 'university',
	'cat' => $cat,
	'category__not_in' => 42
);
$query = new WP_Query($args);
?>

<div class="pt-5">
	<h1 class="h1 heading-home heading-home--center fz-30 color-dimgray fw-300 pt">Liga de debate UNEATLANTICO</h1>
</div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content pb-2">

		<div class="cardLigas cardGalleryy c-grid c-grid-3 " style="gap: 72px; row-gap: 10px;">
			<?php
			if ($query->have_posts()):
				while ($query->have_posts()):
					$query->the_post();
					?>

					<div class="container cardDebate">
						<div class=" card card-wrapped card-wrapped bg-silver-light ">

							<div class="cardGallery-individual p-3 d-flex gap-20">

								<div class='cardGallery-content  cardGallery-end debate' style="width: 60px">
									<div class="staff-member--picture img-responsive circule">
										<?php
										the_post_thumbnail();
										?>
									</div>
								</div>

								<div class="d-flex justify-content-center flex-column">
									<h3 class="cardGallery-center p-2 cardTitle d-flex justify-content-center ">
										<?php the_title('<div class="color-dimgray color-dimgray-a d-flex fz-25 fw-400" style="font-weight: bold;text-align: left;"><a href="' . esc_url(get_permalink()) . '" >', '</a></div>'); ?>
									</h3>
									<div
										class="h3 heading-style-1 heading-style-1--center heading-border--pastel-cyan color-dimgray text-uppercase ">
									</div>

									<div class="text-uppercase">
										<h4 style="padding-top: 10px;color: #58595B;">Semana del 26 de Febrero de 2024</h4>
									</div>
									<div class="fz-16 p-2 color-text mt-2 font-family-light textDescript-card text-left">
										<?php
										if (!has_excerpt()) {
											echo '';
										} else {
											?>
											<?php
											echo get_the_excerpt();
										}
										?>
									</div>
								</div>
							</div>

						</div>


					</div>
					<?php


				endwhile;
				wp_reset_query();
			else:
				get_template_part('template-parts/content', 'none');
			endif;
			wp_reset_postdata();
			?>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->

<?php
if ($query->max_num_pages > 1) {
	echo '<ul class="page-numbers font-family-light page-numbers-space">';
	if ($curpage > 1) {
		echo '<li>
					<a class="previous page-numbers page button btn ml-xl-2 fz-14" href="' . get_pagenum_link(($curpage - 1 > 0 ? $curpage - 1 : 1)) . '">« Anterior</a>
					</li>';
	}

	for ($i = 1; $i <= $query->max_num_pages; $i++) {
		echo "<li>";
		if ($i == $curpage) {
			echo '<span class="current active page button btn ml-xl-2 fz-14" href="' . get_pagenum_link($i) . '">' . $i . '</span>';
		} else {
			echo '<a class="page button btn ml-xl-2 fz-14" href="' . get_pagenum_link($i) . '">' . $i . '</a>';
		}
		echo "</li>";
	}
	if ($curpage != $query->max_num_pages) {
		echo '<li>
				<a class="next page button btn ml-xl-2 fz-14" href="' . get_pagenum_link(($curpage + 1 <= $query->max_num_pages ? $curpage + 1 : $query->max_num_pages)) . '">Siguiente »</a>
				</li>';
	}
	echo '
		</ul>
		';
	wp_reset_postdata();
}
?>