<?php 
	$home_url = home_url();
	$theme_option = flagship_sub_get_global_options();	
	
	if ( $theme_option['flagship_sub_breadcrumbs']  == '1' ) { 
	wp_nav_menu( array( 
				'container' => 'nav',
				'container_class' => 'offset-topgutter',
				'theme_location' => 'main_nav',
				'menu_class' => 'breadcrumbs',
				'items_wrap' => '<ul id="%1$s" class="%2$s"><li><a href="' . $home_url . '">' . $theme_option['flagship_sub_breadcrumb_home'] . '</a></li>%3$s</ul>',
				'walker'=> new flagship_bread_crumb )); 
	}
?>				
