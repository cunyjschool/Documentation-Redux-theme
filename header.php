<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<meta name="copyright" content="Copyright <?php echo date('Y'); ?> City University of New York Graduate School of Journalism" />
	<meta http-equiv="content-language" content="en" />

	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	
	<?php
	/**
	 * All stylesheets are enqueued in functions.php
	 */
	?>

  	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/images/favicon.ico" type="image/x-icon" />

  <?php wp_head(); ?>
  
</head>

<body <?php body_class(); ?>>

<div class="header">
	<div class="container">
		<h4 class="left">All things technology for the CUNY Graduate School of Journalism</h4>
		<a href="http://www.journalism.cuny.edu/" alt="The CUNY Graduate School of Journalism" ><img src="<?php bloginfo('template_directory'); ?>/images/cunyj-logo_h360.png" class="logo right"/></a>
		<div class="clear"></div>
		<?php
		$args = array(
			'theme_location' => 'header-menu',
			'container_class' => 'menu-header-menu-container',
			'menu_id' => 'menu-header-menu',
		);
		wp_nav_menu( $args ); ?>
		</div>
	</div><!-- END .container -->
</div><!-- END .header -->