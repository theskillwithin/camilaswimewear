<?php
/**
 * Template para post category 
 */
get_header();
?>
	<div id="blog">
		<div class="main-container col2-right-layout">
			<div class="main">
				<?php include 'includes/breadcrumb.php'; ?>
				<div class="col-main">
					<div class="page-title">
						<h2>Category: <strong><?php single_cat_title(); ?></strong></h2>
					</div>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<article>
							<header class="page-title">
								<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<i class="fa fa-folder"></i>&nbsp;&nbsp;<?php the_category(', ') ?>&nbsp;&nbsp;
								<?php
								$posttags = get_the_tags();
								if ($posttags) {
								?>
									<i class="fa fa-tags"></i>&nbsp;<?php the_tags( "", " ", "" ); ?>
								<?php } ?>
							</header>
							<?php
								$hasThumb = get_the_post_thumbnail();
								if ( $hasThumb != "") {
							?>
								<?php echo the_post_thumbnail('featured-thumbnail', array()); ?>
							<?php } ?>
							<?php the_excerpt(); ?>
						</article>
					<?php endwhile; wp_reset_postdata(); else: ?>
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					<?php endif; ?>
					<!--  pagination links -->
					<div class="pagination">
						<?php
						global $wp_query;

						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'prev_text' => 'Previous',
						'next_text' => 'Next'
						) );
						?>
					</div>
				</div>
				<div class="col-right sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>