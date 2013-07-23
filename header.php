<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title><?php create_page_title(); ?></title>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/assets/images/favicon.ico" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/assets/images/apple-touch-icon-144x144-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/assets/images/apple-touch-icon-114x114-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/assets/images/apple-touch-icon-72x72-precomposed.png" />
  <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri() ?>/assets/images/apple-touch-icon-57x57-precomposed.png" />
  
  <!-- CSS Files: All pages -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/foundation.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/flagship.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/style.css">
  <link type="text/css" rel="stylesheet" href="http://fast.fonts.com/cssapi/c5f514c7-d786-4bfb-9484-ea6c8fbd263f.css"/>
  
  <!-- CSS Files: Conditionals -->
  
  <!-- Modernizr and Jquery Script -->
  <script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/modernizr.foundation.js"></script>
  <?php wp_enqueue_script('jquery'); ?> 
  <?php wp_head(); ?>
  <?php $theme_option = flagship_sub_get_global_options(); ?>
  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php include_once("parts-analytics.php") ?> 
</head>
<body class="<?php echo $theme_option['flagship_sub_parent_id']; ?> sub-site">
	<header>
		<div class="row show-for-small">
			<div class="three columns centered">
			<div class="mobile-logo"><a href="<?php echo network_home_url(); ?>">Home</a></div>
			</div>
		</div>
	
		<div class="row">
			<div id="search-bar" class="offset-by-eight four mobile-four columns">
				<div class="row">
					<div class="six columns mobile-two">
					
					<form method="GET" action="<?php echo network_site_url('/search'); ?>" role="search">
						<input type="submit" class="icon-search" value="&#xe004;" />
						<input type="text" name="q" placeholder="Search this site" />
					</form>
					</div>
					<div class="six columns links mobile-two hide-for-small">
						<a href="http://www.jhu.edu">jhu.edu</a> |
						<a href="http://library.jhu.edu/">Library</a> |
						<a href="<?php echo network_site_url(); ?>about/contact/">Contact</a>
					</div>
				</div>	
			</div>	<!-- End #search-bar	 -->
		</div>
		<?php //Switch to krieger.jhu.edu for navigation menus
			global $blog_id;
			$current_blog_id = $blog_id;
			switch_to_blog(1);
		?>
		<div class="row">
			<?php wp_nav_menu( array( 
				'theme_location' => 'main_nav', 
				'menu_class' => '', 
				'fallback_cb' => 'foundation_page_menu', 
				'container' => 'nav',
				'container_id' => 'main_nav', 
				'container_class' => 'twelve columns',
				'depth' => 2 )); ?> 
		</div>
		<?php //switch back to the current site
		switch_to_blog($current_blog_id);
		?>	
		</header>