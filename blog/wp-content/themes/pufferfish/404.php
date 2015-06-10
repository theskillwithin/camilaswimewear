<?php 
/**
 * 404 ( Not found page )
 */
get_header();
?>
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="error-content">
					<img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/error.png" alt="404 - Sorry! Page not found">
					<h2>404</h2>
					<p>
						<i>Sorry! Page not found</i><br>
						<span>The page you are looking for has been removed, has been renamed or is temporarily unavailable.</span>
					</p>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>