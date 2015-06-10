<?php
get_header(); 
?>
<div id="blog">
	<div class="main-container col2-right-layout">
		<div class="main">
			<?php include 'includes/breadcrumb.php'; ?>
			<div class="col-main">
				<?php if (have_posts()) : ?>
					<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
					<?php /* If this is a category archive */ if (is_category()) { ?>
						<div class="page-title">
							<h2>Archives by Category: <strong><?php single_cat_title(); ?></strong></h2>
						</div>
					<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
						<div class="page-title">
							<h2>Archives by Tag: <strong><?php single_tag_title(); ?></strong></h2>
						</div>
					<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
						<div class="page-title">
							<h2>Archives by Day: <strong><?php the_time('F jS, Y'); ?></strong></h2>
						</div>
					<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
						<div class="page-title">
							<h2>Archives by Month: <strong><?php the_time('F, Y'); ?></strong></h2>
						</div>
					<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
						<div class="page-title">
							<h2>Archives by Year: <strong><?php the_time('Y'); ?></strong></h2>
						</div>
					<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
						<div class="page-title">
							<h2>Blog Archives</h2>
						</div>
					<?php } ?>
					<?php while (have_posts()) : the_post(); ?>					
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
								<br>							
							<?php } ?>							
							<?php the_excerpt(); ?>
						</article>
					<?php endwhile; ?>				
				<?php else : ?>
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
<div class="blog">
	<div class="container">
		<div class="row">
			<div class="col-md-8">				
												
			</div>
			<div class="col-md-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>