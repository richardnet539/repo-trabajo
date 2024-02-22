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
		'posts_per_page' => 6,
		'paged' => $paged,
		'post_type' => 'latamleague',
		'cat' =>  $cat,
		'category__not_in' => 42
	);
	$query = new WP_Query($args);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content pb-5">
		<div class="c-grid c-grid-3 cardGallery">
		<?php
			if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
		?>
			<div class="cardGallery-individual p-3">
				<h3 class='cardGallery-center p-2 cardTitle"'>
					<?php the_title('<div class="color-dimgray fz-25 fw-400"><a href="' . esc_url(get_permalink()) . '" >', '</a></div>'); ?>
				</h3>
				<a class="color-dimgray" href="<?php the_permalink(); ?>">
					<div class='cardGallery-content cardGallery-center'>
						<?php
							the_post_thumbnail();
						?>
					</div>
				<div class="fz-16 p-2 color-text mt-2 font-family-light textDescript-card">
					<?php 
						if ( ! has_excerpt() ) {
							echo '';
						} else { 
							?>
							<span class="color-primary">Description: </span>
							<?php
							echo get_the_excerpt();
						}
					?>
				</div>
			</a>
		</div>
		<?php
			endwhile;
				wp_reset_query();
			else :
				get_template_part('template-parts/content', 'none');
			endif;
			wp_reset_postdata();
		?>
	</div>
</div>

</article><!-- #post-<?php the_ID(); ?> -->

					<?php
			if($query->max_num_pages > 1) {
			echo '<ul class="page-numbers font-family-light">';
					if($curpage > 1) {
						echo '<li>
					<a class="previous page-numbers page button btn ml-xl-2 fz-14" href="'.get_pagenum_link(($curpage-1 > 0 ? $curpage-1 : 1)).'">« Anterior</a>
					</li>';
				}
			
			for($i=1;$i<=$query->max_num_pages;$i++) {
				echo "<li>";
				if ($i == $curpage) {
				echo '<span class="current active page button btn ml-xl-2 fz-14" href="'.get_pagenum_link($i).'">'.$i.'</span>';
				} else {
				echo '<a class="page button btn ml-xl-2 fz-14" href="'.get_pagenum_link($i).'">'.$i.'</a>';
				}
				echo "</li>";
			}
			if($curpage != $query->max_num_pages) {
				echo '<li>
				<a class="next page button btn ml-xl-2 fz-14" href="'.get_pagenum_link(($curpage+1 <= $query->max_num_pages ? $curpage+1 : $query->max_num_pages)).'">Siguiente »</a>
				</li>';
			}
			echo '
		</ul>
		';
		wp_reset_postdata();
			}
					?>
