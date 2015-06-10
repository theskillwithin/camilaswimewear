<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Pufferfish
 * @since Pufferfish 1.0
 */
 
 get_header(); ?>
 
 <!--<div class="container">
	<div class="row">
		<div class="span8">
			<p>left side</p>
		</div>
		<div class="span4">
			<p>right side</p>
		</div>
	</div>
</div>-->

<div class="container">
	<div class="row">
		<div class="span8">						
			<?php if ( have_posts() ) { ?>
			<?php
			while ( have_posts() ) :
				the_post();
			?>                
				<div class="post-item">
					<div class="post-info">
						<div class="edit-post">
						<?php edit_post_link( "Edit" ); ?> 
						</div>
						<h2 class="post-title">
							<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
						</h2>
					</div>
					<div class="post-content">                        
						<?php 
						$hasThumb = get_the_post_thumbnail();
						if ( $hasThumb != "") { 
						?>							
							<div class="content">
								<?php echo get_the_post_thumbnail($page->ID, 'full'); ?>
								<?php the_excerpt(); ?>
							</div>
						<?php } else { ?>
							<div class="content">
								<?php the_excerpt(); ?>
							</div>
						<?php } ?>
					</div>
					<div class="post-footer">						
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="btn-read-more">Read More</a>
					</div>
				</div>
				<?php
			endwhile; 
			wp_reset_postdata();			
				} 
				else {?>
				<h3 class="title-filter">No results for this category</h3>    
				<?php } ?>
				<!--  pagination links -->				
				<?php bootstrap_pagination(); ?>				
		</div>
		<div class="span4">
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>