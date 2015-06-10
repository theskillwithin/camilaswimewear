<?php
/** 
 * @file functions.php
 * @package Camila 
 */

function generic_wp_setup() {
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );	
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
	add_image_size('generic-small', 100, 100, true);
}
add_action( 'after_setup_theme', 'generic_wp_setup' );

define( 'HOME_URI', home_url() );
define( 'THEME_URI', get_stylesheet_directory_uri() );
define( 'THEME_IMG', THEME_URI . '/images' );
define( 'THEME_CSS', THEME_URI . '/css' );
define( 'THEME_JS', THEME_URI . '/js' );

add_filter( 'wp_title', 'rw_title', 10, 3 );
/*page title*/
function rw_title( $title, $sep, $seplocation )
{
	global $page, $paged;
	// Don't affect in feeds.
	if ( is_feed() )
		return $title;
	// Add the blog name
	if ( 'right' == $seplocation )
		$title .= get_bloginfo( 'name' );
	else
		$title = get_bloginfo( 'name' ) . $title;
	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " {$sep} {$site_description}";
	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
	return $title;
}

// Register Sidebar
function custom_sidebar() {

	register_sidebar( array(
		'name' => 'Logo',
		'id' => 'logo-img',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => 'Top Message',
		'id' => 'top-message',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => 'Footer Column 1',
		'id' => 'footer-col-1',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => 'Footer Column 2',
		'id' => 'footer-col-2',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => 'Footer Column 3',
		'id' => 'footer-col-3',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => 'Footer Column 4',
		'id' => 'footer-col-4',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );
	
	register_sidebar( array(
		'name' => 'Footer Text',
		'id' => 'footer-text',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => ''
	) );
}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'custom_sidebar' );

//add class to link
function add_menuclass($ulclass) {
   return preg_replace('/<a /', '<a class="level0"', $ulclass);
}
add_filter('wp_nav_menu','add_menuclass');

// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
	return ' <a class="moretag" href="'. get_permalink($post->ID) . '">Read More <i class="fa fa-chevron-circle-right"></i>
</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');
?>