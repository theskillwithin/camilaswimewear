<?php
/** 
 * @file functions.php
 * @package Pufferfish
 * @subpackage Pufferfish 1.0
 */
function pufferfish_wp_setup() {
     //remove innecessary tags on head
     remove_action('wp_head', 'wp_generator');
     remove_action('wp_head', 'rsd_link');
     remove_action('wp_head', 'feed_links', 2);
     remove_action('wp_head', 'index_rel_link');
     remove_action('wp_head', 'wlwmanifest_link');
     remove_action('wp_head', 'feed_links_extra', 3);
     remove_action('wp_head', 'start_post_rel_link', 10, 0);
     remove_action('wp_head', 'parent_post_rel_link', 10, 0);
     remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
     remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); 
     remove_action('wp_head', 'rel_canonical' );
     
    // add menu options to admin panel
    add_theme_support( 'menus' );
}
add_action( 'after_setup_theme', 'pufferfish_wp_setup' );
// Register Sidebar
function pufferfish_sidebar()  {

	$args = array(
		'id'            => 'blog-sidebar',
		'name'          => __( 'Blog Sidebar' ),
		'description' => __( 'Sidebar para el blog.' ),
		'before_title'  => '<h4 class="widgettitle">',
		'after_title'   => '</h4>',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	);
	register_sidebar( $args );

}

// Hook into the 'widgets_init' action
add_action( 'widgets_init', 'pufferfish_sidebar' );
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 250, 250);

function bootstrap_pagination($pages = '', $range = 2)
{
$showitems = ($range * 2)+1;

global $paged;
if(empty($paged)) $paged = 1;

if($pages == '')
{
global $wp_query;
$pages = $wp_query->max_num_pages;
if(!$pages)
{
$pages = 1;
}
}

if(1 != $pages)
{
echo "<div class='pagination pagination-centered'><ul>";
if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

for ($i=1; $i <= $pages; $i++)
{
if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
{
echo ($paged == $i)? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
}
}

if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
echo "</ul></div>\n";
}
}
?>
