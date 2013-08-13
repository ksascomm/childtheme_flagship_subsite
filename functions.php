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
	
function get_meta_values( $key = '', $type = 'profile', $status = 'publish' ) {
    global $wpdb;
    if( empty( $key ) )
        return;
    $r = $wpdb->get_col( $wpdb->prepare( "
        SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
        LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
        WHERE pm.meta_key = '%s' 
        AND p.post_status = '%s' 
        AND p.post_type = '%s'
        ORDER BY pm.meta_value DESC
    ", $key, $status, $type ) );
    return $r;
}

add_filter('posts_join', 'profile_alpha_join' );
function profile_alpha_join($wp_join)
{
	if(is_page_template('template-profile-index.php') || is_page_template('template-profile-search-results.php')) {
		global $wpdb;
		$wp_join .= " LEFT JOIN (
				SELECT DISTINCT post_id,
				CASE WHEN meta_key = 'ecpt_award_alpha' THEN meta_value END AS ecpt_award_alpha
				FROM $wpdb->postmeta
				WHERE meta_key = 'ecpt_award_alpha') AS DD
				ON $wpdb->posts.ID = DD.post_id
				LEFT JOIN (
				SELECT DISTINCT post_id,
				CASE WHEN meta_key = 'ecpt_class_year' THEN meta_value END AS ecpt_class_year
				FROM $wpdb->postmeta
				WHERE meta_key = 'ecpt_class_year') AS EE
				ON DD.post_id = EE.post_id
				"; 
	}
	return ($wp_join);
}	

add_filter('posts_orderby', 'profile_index_order' );
function profile_index_order( $orderby )
{
	if(is_page_template('template-profile-index.php') || is_page_template('template-profile-search-results.php')) {
			$orderby = "EE.ecpt_class_year DESC, DD.ecpt_award_alpha ASC";
	}
 	return $orderby;
}
?>