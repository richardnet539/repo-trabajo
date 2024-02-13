<?php
/**
 * Template Name: Special Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package liga-de-debate
 */

get_header();
?>
<div class="container">
<h1 class="page-title heading-home heading-home--center fz-30 color-dimgray fw-300 last-news"><?php esc_html_e( 'Últimas Noticias', 'ligaDebate' ); ?></h1>
<div id="primary" class="content-area">
	
	<main id="main" class="site-main">
	
	<?php

	global $paged;
	$curpage = $paged ? $paged : 1;
	$args = array(
		'orderby' => 'post_date',
		'posts_per_page' => 5,
		'paged' => $paged,
		'cat' =>  $cat,
		'category__not_in' => 42
	);
	$query = new WP_Query($args);
	if($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
	?>
<article class="post-item row mt-4 mb-4">
							<div class="post-item__image col-md-4 ">
								<img src="<?php echo  get_the_post_thumbnail_url() ?>" alt="new-image">
							</div>
							<div class="post-item__body col-md-8 ">
								<div class="post-item__body__information pb-4">
									<div class="post-item__body__information__date"><img src="/wp-content/themes/ligaDebate-blog/img/calendar.png" alt="">

										<?php

										echo get_the_date('d F Y')
										?>

									</div>
									<?php the_title('<div class="h2 post-item__body__information__title post-item__body__information__title--news"><a href="' . esc_url(get_permalink()) . '" >', '</a></div>'); ?>

									<div class="post-item__body__information__tags">
										<?php
										$post_categories = wp_get_post_categories($post->ID);


										$html = '';
										foreach ($post_categories as $post_category) {

											get_category($post_category);
										}
										echo $html;
										?>

									</div>
									<div class="post-item__body__information__extract">
										<?php echo wp_strip_all_tags(get_the_content()); ?>
									</div>

								</div>
								<div class="post-item__body__more">
								<a href="<?php echo esc_url(get_permalink()) ?>"><button>Leer Más</button></a>
								</div>
							</div>
						</article>
						<hr>
				<?php
					endwhile;
					wp_reset_query();
				else :
					get_template_part('template-parts/content', 'none');
				endif;
				wp_reset_postdata();
				?>
				<?php
		if($query->max_num_pages > 1) {
		echo '<ul class="page-numbers">';
				if($curpage > 1) {
					echo '<li>
				<a class="previous page-numbers page button" href="'.get_pagenum_link(($curpage-1 > 0 ? $curpage-1 : 1)).'">« Anterior</a>
				</li>';
			}
        
          for($i=1;$i<=$query->max_num_pages;$i++) {
            echo "<li>";
            if ($i == $curpage) {
              echo '<span class="current active page button" href="'.get_pagenum_link($i).'">'.$i.'</span>';
            } else {
              echo '<a class="page button" href="'.get_pagenum_link($i).'">'.$i.'</a>';
            }
            echo "</li>";
          }
		  if($curpage != $query->max_num_pages) {
			  echo '<li>
			  <a class="next page button" href="'.get_pagenum_link(($curpage+1 <= $query->max_num_pages ? $curpage+1 : $query->max_num_pages)).'">Siguiente »</a>
			</li>';
		  }
          echo '
       </ul>
       ';
       wp_reset_postdata();
		}
				?>
			</main>
















</div><!-- #primary -->
<?php //get_sidebar(); ?>
</div>
<?php
get_footer();
