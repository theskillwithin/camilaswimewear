<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="header">
 *
 * @package WordPress
 * @subpackage Pufferfish
 * @since Pufferfish 1.0
 */ 
?>
<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width">
<title>PufferfishSwimwear Blog</title>
<link href='http://fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
<link rel='shortcut icon' type='image/x-icon' href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fancybox/jquery.fancybox.css" media="screen" />
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/fonts/genericons.css">
<link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--[if lte IE 8]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body>
	<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="span12">  			        
						<p class="top-text">Our swimwear is sold exclusively at Brownie’s YachtDiver Stores: <br />
						<em>2301 S. Federal Hwy. - Fort Lauderdale, FL 33316</em>&nbsp;---&nbsp;<em>3619 Broadway - North Palm Beach, FL 33404</em></p>
					</div>
				</div>
			</div>
		</div>
		<div class="container">    	
			<div class="row">
				<div class="span12">
					<div class="nav-container">    	
						<div class="responsive-menu hidden-desktop">
							<div class="navbar">
								<div class="navbar-inner">
									<div class="container">
										<a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar"><p class="brand">Menu</p></a>
										<div class="nav-collapse collapse">
											<nav>
												<ul>
													<li><a title="Home" href="http://www.pufferfishswimwear.com/Default.aspx">Home</a></li>
													<li><a title="About Us" href="http://www.pufferfishswimwear.com/AboutUs.aspx">About Us</a></li>
													<li><a title="Collections" href="http://www.pufferfishswimwear.com/Collections.aspx">Collections</a></li>
													<li><a title="Size Chart" href="http://www.pufferfishswimwear.com/SizeChart.aspx">Size Chart</a></li>
													<li><a title="Blog" href="http://www.pufferfishswimwear.com/blog">Blog</a></li>
													<li><a title="Contact Us" href="http://www.pufferfishswimwear.com/ContactUs.aspx">Contact Us</a></li>
												</ul>
											</nav>
										</div>						 
									</div>
								</div>
							</div>                        
						</div>
						<div class="row visible-desktop">
							<div class="span3">
								<a title="Pufferfish Swimwear" class="logo pull-left" href="http://www.pufferfishswimwear.com/Default.aspx"></a>
							</div>
							<div class="span9">                        	
								<nav class="pull-right">
									<ul>
										<li><a title="Home" href="http://www.pufferfishswimwear.com/Default.aspx">Home</a></li>
										<li><a title="About Us" href="http://www.pufferfishswimwear.com/AboutUs.aspx">About Us</a></li>
										<li><a title="Collections" href="http://www.pufferfishswimwear.com/Collections.aspx">Collections</a></li>
										<li><a title="Size Chart" href="http://www.pufferfishswimwear.com/SizeChart.aspx">Size Chart</a></li>
										<li><a title="Blog" class="active" href="http://www.pufferfishswimwear.com/blog">Blog</a></li>
										<li><a title="Contact Us" href="http://www.pufferfishswimwear.com/ContactUs.aspx">Contact Us</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>