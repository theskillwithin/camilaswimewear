<?php
/**
 * Template for post
 *
 * @file single.php
 */
get_header();
?>	
	<div id="blog">
		<div class="main-container col2-right-layout">
			<div class="main">
				<?php include 'includes/breadcrumb.php'; ?>
				<div class="col-main">
					<article>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<header>
							<h2><?php echo the_title(); ?></h2>
							<i class="fa fa-folder"></i>&nbsp;&nbsp;<?php the_category(', ') ?>&nbsp;&nbsp;
							<?php
							$posttags = get_the_tags();
							if ($posttags) {
							?>
								<i class="fa fa-tags"></i>&nbsp;<?php the_tags( "", " ", "" ); ?>
							<?php } ?>
						</header>
						<?php the_content(); ?>
						<?php endwhile; else: ?>
							<p><?php _e("Sorry, but you are looking for something that isn't here."); ?></p>
						<?php endif; ?>
					</article>
					<!-- Pagination -->
					<div id="post_pagination">						
						<?php $prevPost = get_previous_post();
							if($prevPost) {
								$args = array(
									'posts_per_page' => 1,
									'include' => $prevPost->ID
								);
								$prevPost = get_posts($args);
								foreach ($prevPost as $post) {
									setup_postdata($post);
						?>
							<a href="<?php the_permalink(); ?>"><i class="fa fa-angle-double-left"></i> Previous Post</a>
						<?php
									wp_reset_postdata();
								} //end foreach
							} // end if
						?>
						|
						<?php $nextPost = get_next_post();
							if($nextPost) {
								$args = array(
									'posts_per_page' => 1,
									'include' => $nextPost->ID
								);
								$nextPost = get_posts($args);
								foreach ($nextPost as $post) {
									setup_postdata($post);
						?>
							<a href="<?php the_permalink(); ?>">Next Post <i class="fa fa-angle-double-right"></i></a>
						<?php
									wp_reset_postdata();
								} //end foreach
							} // end if
						?>
					</div>
					<!-- Pagination -->
				</div>
				<div class="col-right sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>