<?php get_header(); ?>
<?php
	if ( false === ( $sub_research_slider_query = get_transient( 'sub_research_slider_query' ) ) ) {
				// It wasn't there, so regenerate the data and save the transient
				$sub_research_slider_query = new WP_Query(array(
				'post_type' => 'profile',
				'category_name' => 'homepage',
				'order' => 'rand',
				'posts_per_page' => '5'));
			set_transient( 'sub_research_slider_query', $sub_research_slider_query, 86400 ); }
?>
<?php if ($sub_research_slider_query->have_posts()) : ?>
<div class="row">
<div id="slider" class="twelve columns radius10 no-gutter">

<?php while ($sub_research_slider_query->have_posts()) : $sub_research_slider_query->the_post(); ?>
<a href="<?php the_permalink(); ?>">
<div class="slide">
	<summary class="four columns black_bg offset-by-eight radius-topright" id="caption">
		
		<div class="middle">
			<h3 class="white"><?php the_title(); ?></h3>
			<h5 class="white italic"><?php $tagline = get_post_meta($post->ID, 'ecpt_pull_quote', true); echo strip_tags($tagline); ?></h5>
			<h6 class="yellow">Read More <span class="icon-arrow-right-2"></span></h6>
		</div>
	
	</summary>
	<?php the_post_thumbnail('slider', array('class' => 'radius-top')); ?>
</div>
</a>
<?php endwhile; ?>
				
					
</div>
</div>
<?php endif; ?>
<div class="row sidebar_bg radius10">
	<?php locate_template('parts-nav-sidebar.php', true, false); ?>	
	<div class="eight columns wrapper toplayer pull-four">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<section>
				<h2 class="blue"><?php the_title();?></h2>	
				<?php the_content(); ?>			
			</section>
		<?php endwhile; endif; ?>	
		
		
		
		<?php if ( false === ( $sub_news_query = get_transient( 'sub_news_query' ) ) ) {
				// It wasn't there, so regenerate the data and save the transient
				$theme_option = flagship_sub_get_global_options(); 
			$news_quantity = $theme_option['flagship_sub_news_quantity'];
			$sub_news_query = new WP_Query(array(
				'post_type' => 'post',
				'posts_per_page' => $news_quantity)); 
					set_transient( 'sub_news_query', $sub_news_query, 2592000 ); }
			if ( $sub_news_query->have_posts() ) :
		?>
		<h4><?php echo $theme_option['flagship_sub_feed_name']; ?></h4>
		<?php endif; while ($sub_news_query->have_posts()) : $sub_news_query->the_post(); ?>
		<div class="row">		
		<section class="twelve columns">
				<a href="<?php the_permalink(); ?>">
					<h5 class="black"><?php the_title();?></h5>
					<?php if ( has_post_thumbnail()) { ?> 
						<div class="floatright">
							<?php the_post_thumbnail('rss'); ?>
						</div>
					<?php } ?>
					<?php the_excerpt(); ?>
				</a>
				<hr>
		</section>
		</div>
		<?php endwhile; ?>
		
	</div>	<!-- End main content (left) section -->

</div> <!-- End #landing -->
<?php get_footer(); ?>