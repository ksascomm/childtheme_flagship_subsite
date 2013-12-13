  <footer>
	<?php //Switch to krieger.jhu.edu for navigation menus
		global $switched;
		switch_to_blog(1);
	?>
  	<div class="row">
		<?php wp_nav_menu( array( 
		'theme_location' => 'quick_links', 
		'menu_class' => 'nav-bar', 
		'fallback_cb' => 'foundation_page_menu', 
		'container' => 'nav', 
		'container_id' => 'quicklinks',
		'container_class' => 'three column', 
		'walker' => new foundation_navigation() ) ); ?>
  		
		<?php wp_nav_menu( array( 
		'theme_location' => 'footer_links', 
		'menu_class' => 'inline-list', 
		'fallback_cb' => 'foundation_page_menu', 
		'container' => 'nav', 
		'container_class' => 'seven column', 
		'walker' => new foundation_navigation() ) ); ?>
		
		<?php //switch back to the current site
		restore_current_blog();
		?>	
		<nav class="two column iconfont" id="social-media">
			<a href="http://facebook.com/jhuksas" title="Facebook"><span class="icon-facebook"></span></a>
			<a href="http://vimeo.com/channels/jhuksas" title="Vimeo"><span class="icon-vimeo"></span></a>
		</nav>
  	</div>
  </footer>

  <?php locate_template('parts-script-initiators.php', true, false); ?>
  
  <?php $theme_option = flagship_sub_get_global_options();

  		if ( $theme_option['flagship_sub_parent_id']  == 'research' ) { ?>
	    <script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
			$j('#menu-item-872').addClass('current_page_ancestor');
			$j('#menu-item-<?php echo $theme_option['flagship_sub_menu_id']; ?>').addClass('current_page_parent');
			});
		</script>
<?php } if ( $theme_option['flagship_sub_parent_id']  == 'about' ) { ?>
	    <script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
			$j('#menu-item-808').addClass('current_page_ancestor');
			$j('#menu-item-<?php echo $theme_option['flagship_sub_menu_id']; ?>').addClass('current_page_parent');
			});
		</script>
<?php } if ( $theme_option['flagship_sub_parent_id']  == 'academics' ) { ?>
	    <script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
			$j('#menu-item-813').addClass('current_page_ancestor');
			$j('#menu-item-<?php echo $theme_option['flagship_sub_menu_id']; ?>').addClass('current_page_parent');
			});
		</script>
<?php } if ( $theme_option['flagship_sub_parent_id']  == 'admissions' ) { ?>
	    <script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
			$j('#menu-item-899').addClass('current_page_ancestor');
			$j('#menu-item-<?php echo $theme_option['flagship_sub_menu_id']; ?>').addClass('current_page_parent');
			});
		</script>
<?php } if ( $theme_option['flagship_sub_parent_id']  == 'news' ) { ?>
	    <script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
			$j('#menu-item-885').addClass('current_page_ancestor');
			$j('#menu-item-<?php echo $theme_option['flagship_sub_menu_id']; ?>').addClass('current_page_parent');
			});
		</script>
<?php } if ( $theme_option['flagship_sub_parent_id']  == 'giving' ) { ?>
	    <script>
		var $j = jQuery.noConflict();
		$j(document).ready(function(){
			$j('#menu-item-897').addClass('current_page_ancestor');
			$j('#menu-item-<?php echo $theme_option['flagship_sub_menu_id']; ?>').addClass('current_page_parent');
			});
		</script>
<?php } ?>

<?php if ( is_front_page()) { ?>
	<script src="<?php echo get_template_directory_uri() ?>/assets/javascripts/min.foundation.orbit.js"></script>
	<script>
		var $l = jQuery.noConflict();
		$l(window).load(function() {
        $l("#slider").orbit({
        	'animation' : 'fade',
        	'animationSpeed': 1000,
        	'timer' : true,
        	'advanceSpeed' : 7000,
        	'directionalNav' : false,
	        'bullets' : false,		
        });
   });
   </script>
<?php } wp_footer(); ?>