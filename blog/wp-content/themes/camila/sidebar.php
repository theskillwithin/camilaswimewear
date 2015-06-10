<aside>
	<!-- Latest Posts -->
	<div class="sidebar-panel">
		<h3>Latest News</h3>
		<ul>
			<?php wp_get_archives( array( 'type' => 'postbypost', 'limit' => 5 ) ); ?>
		</ul>	
	</div>
	<!-- Categories -->
	<div class="sidebar-panel">
		<h3>Categories</h3>
		<ul>
		<?php
			$args = array(
				'orderby' => 'name',
				'order' => 'ASC'
			);
			$categories = get_categories($args);
			foreach($categories as $category) {
				echo '<li><a class="list-group-item" href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name .'</a></li>';
			}
		?>
		</ul>
	</div>
	<!-- Tags -->
	<div class="sidebar-panel">
		<h3>Tags</h3>
		<ul class="tag-list">
			<?php
				$args = array(
					'orderby' => 'name',
					'order' => 'ASC'
				);
				$tags = get_tags($args);
				foreach($tags as $tag) {
					echo '<li><a href="' . get_tag_link( $tag->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $tag->name ) . '" ' . '>' . $tag->name .'</a></li>';
				}
			?>
		</ul>
	</div>
</aside>