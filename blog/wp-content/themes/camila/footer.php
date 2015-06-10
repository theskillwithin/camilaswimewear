<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content.
 *
 * @package WordPress
 * @subpackage Camila
 */
?>		
			<div class="footer-container">
				<div class="footer">
					<div class="links">
						<?php dynamic_sidebar('footer-col-1'); ?>
					</div>
					<div class="links">
						<?php dynamic_sidebar('footer-col-2'); ?>						
					</div>
					<div class="links">
						<?php dynamic_sidebar('footer-col-3'); ?>						
					</div>
					<div class="links social-media">
						<?php dynamic_sidebar('footer-col-4'); ?>						
					</div>
					<?php dynamic_sidebar('footer-text'); ?>					
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo THEME_JS; ?>/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="<?php echo THEME_JS; ?>/prototype.js"></script>
		<script type="text/javascript" src="<?php echo THEME_JS; ?>/app.js"></script>
		<?php wp_footer(); ?>
	</body>
</html>