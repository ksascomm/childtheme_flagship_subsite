<?php
//Add Theme Options Page
	if(is_admin()){	
		require_once('assets/functions/theme-options-init.php');
	}
	
	//Collect current theme option values
		function flagship_sub_get_global_options(){
			$flagship_sub_option = array();
			$flagship_sub_option 	= get_option('flagship_sub_options');
		return $flagship_sub_option;
		}
	
	//Function to call theme options in theme files 
		$flagship_sub_option = flagship_sub_get_global_options();


	add_image_size( 'slider', 1000, 425, true );
//Register Sidebar
	if ( function_exists('register_sidebar') )
		register_sidebar(array(
			'name'          => 'Under Navigation',
			'id'            => 'under-nav-sb',
			'description'   => '',
			'before_widget' => '<div id="widget" class="widget %2$s row">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="blue_bg widget_title"><h5 class="white">',
			'after_title'   => '</h5></div>' 
			));

function delete_subsite_transients($post_id) {
	global $post;
	if (isset($_GET['post_type'])) {		
		$post_type = $_GET['post_type'];
	}
	else { $post_type = $post->post_type; }
	
	switch($post_type) {
		case 'profile' :
			delete_transient('sub_research_slider_query');
			for ($i=1; $i < 5; $i++) { 
				delete_transient('research_profile_index_query_' . $i); 
			}
		break;
		
		case 'post' :
			delete_transient('sub_news_query');	
		break;
	}
}
	add_action('save_post','delete_subsite_transients'); 
?>