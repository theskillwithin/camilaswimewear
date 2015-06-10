<?php
/*
Plugin Name: Camila Logo
Plugin URI: http://ddevcom.com
Description: Plugin to add custom logo
Version: 1.0
Author: DDEVCOM
Author URI: http://ddevcom.com
License: GPL2
*/
class wp_camila_logo extends WP_Widget {

	// constructor
    function wp_camila_logo() {
        parent::WP_Widget(false, $name = __('Camila Logo', 'wp_camila_logo_plugin') );
    }
	
	// widget form creation
	function form($instance) {

		// Check values
		if( $instance) {
			$title = esc_attr($instance['title']);
			$link = esc_attr($instance['link']);
			$textarea = esc_textarea($instance['textarea']);
		} else {
			$title = '';
			$link = '';
			$textarea = '';
		}
		
		?>		
		<p>
		<label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link:', 'wp_camila_logo_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
		</p>
		
		<p>
			<label>Logo Image</label>
			<?php echo pco_image_field( $this, $instance, array( 'field' => 'logo_image_id' ) ); ?>
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'wp_camila_logo_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Description', 'wp_camila_logo_plugin'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>
		<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		// Fields
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['link'] = strip_tags($new_instance['link']);
		$instance['textarea'] = strip_tags($new_instance['textarea']);
		
		// Image Field
		$instance['logo_image_id'] = strip_tags( $new_instance['logo_image_id']);
		
		return $instance;
	}

	// display widget
	function widget($args, $instance) {
		extract( $args );
		// these are the widget options
		$title = apply_filters('widget_title', $instance['title']);
		$link = $instance['link'];
		$textarea = $instance['textarea'];
		
		$logo_img = $instance['logo_image_id'];
		
		echo $before_widget;
		
		// Display the widget		
		
		?>
			<a href="<?php echo $link; ?>" title="<?php echo $title; ?>" class="logo"><img src="<?php echo wp_get_attachment_url( $logo_img ); ?>" alt="<?php echo $textarea; ?>"></a>			
        <?php
		
		echo $after_widget;
	}
}
add_action('widgets_init', create_function('', 'return register_widget("wp_camila_logo");'));