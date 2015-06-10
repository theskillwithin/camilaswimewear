<?php

/**
 * Template asignado para single posts
 *
 * @package WordPress
 * @subpackage Pufferfish
 * @since Pufferfish 1.0
 */

get_header(); 

?>

<div class="container">
	<div class="row">
		<div class="span8">
			<?php 
            while ( have_posts() )
            {
                the_post();
                ?>
                <div class="post-item">
                    <div class="post-info">
                        <div class="edit-post">
                            <?php edit_post_link( "Edit" ); ?> 
                        </div>
                        <h2 class="post-title">
                            <?php the_title(); ?>
                        </h2>
                        <div class="post-meta">
                            <span class="date"><?php echo get_the_date(); ?></span>                            
                        </div>
                    </div>                    
                    <div class="post-content post-content-single row">                        
                        <div class="span8"><?php the_content(); ?></div>
                    </div>
					<?php                        
                        echo '<h3 class="comment-title">Comments</h3>';  
                        comments_template( '', true );
                    ?>
                </div> 
                <?php
            } 
            ?>
		</div>
		<div class="span4">
			<?php dynamic_sidebar('blog-sidebar'); ?>
		</div>
	</div>
</div>

<?php

get_footer(); 
