<?php get_header(); ?>
	<div id="blog">
		<div class="main-container col1-layout">
			<div class="main">
				<?php include 'includes/breadcrumb.php'; ?>
				<div class="col-main">				
					<?php if ( have_posts() && strlen( trim(get_search_query()) ) != 0 ) : ?>
						<div class="page-title">
							<h2>Search results for: <strong><?php echo get_search_query(); ?></strong></h2>
						</div>
						<?php while ( have_posts() ) : the_post(); ?>
							<article>
								<?php if ( has_post_thumbnail() ) : ?>										
									<a class="thumbnail" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'thumbnail' ); ?>
									</a>
									<header>
										<h2>
											<a title="<?php the_title();?>" href="<?php the_permalink(); ?>">
												<?php the_title(); ?>
											</a>											
										</h2>
										<i class="fa fa-folder"></i>&nbsp;&nbsp;<?php the_category(', ') ?>&nbsp;&nbsp;
										<?php
										$posttags = get_the_tags();
										if ($posttags) {
										?>
											<i class="fa fa-tags"></i>&nbsp;<?php the_tags( "", " ", "" ); ?>
										<?php } ?>
									</header>
									<?php the_excerpt();?>
								<?php else : ?>										
									<h2>
										<a title="<?php the_title();?>" href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h2>
									<?php the_excerpt();?>											
								<?php endif ;?>
							</article>
						<?php endwhile; ?>
					<?php else : ?>
						<div class="page-title">
							<h2>No results found</h2>
						</div>					
						<p>Your search returns no results.<br>Try again with different search term.</p>
					<?php endif ;?>
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
			</div>
		</div>
	</div>
<?php get_footer(); ?>