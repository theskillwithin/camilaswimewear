<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section>
 *
 * @package WordPress
 * @subpackage Camila
 */ 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta content="initial-scale=1.0, width=device-width" name="viewport">
	<title><?php wp_title( '|', true, 'left' ); ?></title>
	<link type="image/x-icon" href="<?php echo THEME_IMG; ?>/favico.png" rel="shortcut icon">    
    <link rel="stylesheet" href="<?php echo THEME_CSS; ?>/camila.css">
	<?php wp_head(); ?>
</head>
<body>
	<div class="wrapper">
		<header class="page-header">
			<div class="header-language-background">
		    	<div class="header-language-container">		        	
					<?php dynamic_sidebar('top-message'); ?>
		        </div>
		    </div>
            <div class="page-header-container">
            	<?php dynamic_sidebar('logo-img'); ?>
                <div class="skip-links">					
                	<a class="skip-link skip-nav" href="#header-nav">
		                <span class="icon"></span>
		                <span class="label">Menu</span>
		            </a>
                    <a class="skip-link skip-search" href="#header-search">
		                <span class="icon"></span>
		                <span class="label">Search</span>
		            </a>
                	<a class="skip-link skip-account" href="#header-account">
		                <span class="icon"></span>
		                <span class="label">Account</span>
		            </a>
                </div>
                <div class="skip-content" id="header-search">
                    <?php get_search_form(); ?>
        		</div>
                <div class="skip-content" id="header-nav">
					<nav id="nav">
						<?php wp_nav_menu( array( 'menu' => 'Top Menu', 'items_wrap' => '<ol class="nav-primary">%3$s</ol>', 'container' => FALSE ) ); ?>						
					</nav>
                </div>
                <div class="skip-content" id="header-account">
                    <div class="links">
						<?php wp_nav_menu( array( 'menu' => 'Account Menu', 'items_wrap' => '<ul>%3$s</ul>', 'container' => FALSE ) ); ?>                    	
                    </div>
                </div>
            </div>
		</header>