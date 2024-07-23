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
		'posts_per_page' => 5,
		'paged' => $paged,
		'post_type' => 'spanishleague',
		'cat' =>  $cat,
		'category__not_in' => 42
	);
	$query = new WP_Query($args);
?>
<header class="entry-header pt-5">
		<?php the_title('<h1 class="heading-home heading-home--center fz-30 color-dimgray fw-300">', '</h1>'); ?>
</header>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="entry-content pb-5 container">
        <div class="card-leagues-container">
            <?php
            if ($query->have_posts()):
                $counter = 0;
                while ($query->have_posts()):
                    $query->the_post();
                    $counter++;
                    if ($counter == 1) {
                        ?>
						<div class="d-flex justify-content-center">
							<div class="card-leagues card-leagues__first" onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>'" style="cursor: pointer;">
								<div class="card-leagues__img">
									<?php the_post_thumbnail(); ?>
								</div>
								<div class="card-leagues__description">
									<?php the_title('<h2 class="color-dimgray-a"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>
									<hr>
									<p>
										<?php
										if (!has_excerpt()) {
											echo '';
										} else {
											echo get_the_excerpt();
										}
										?>
									</p>
									<span><?php echo rwmb_meta('date_publication'); ?></span>
								</div>
							</div>
						</div>
                        <?php
                    } else {
                        if ($counter == 2) echo '<div class="card-leagues-group">';
                        ?>
                        <div class="card-leagues" onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>'" style="cursor: pointer;">
                            <div class="card-leagues__img">
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <div class="card-leagues__description">
                                <?php the_title('<h2><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>
                                <hr>
                                <p>
                                    <?php
                                    if (!has_excerpt()) {
                                        echo '';
                                    } else {
                                        echo get_the_excerpt();
                                    }
                                    ?>
                                </p>
                                <span><?php echo rwmb_meta('date_publication'); ?></span>
                            </div>
                        </div>
                        <?php
                        if ($counter == $query->post_count) echo '</div>';
                    }
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

