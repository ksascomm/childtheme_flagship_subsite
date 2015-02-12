<?php get_header(); ?>

<div class="row sidebar_bg radius10">
<?php locate_template('parts-nav-sidebar.php', true, false); ?>	
	<section class="eight columns pull-four wrapper radius-left">
	
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="row">
			<h2 class="blue no-margin"><?php the_title(); ?></h2>
			<h6 class="no-margin">
			    <?php if ( get_post_meta($post->ID, 'ecpt_class_year', true) ) : ?>Year:&nbsp;<?php echo get_post_meta($post->ID, 'ecpt_class_year', true);?>&nbsp;&nbsp;&nbsp;<?php endif;?>
			    <?php 	//Get the Academic Department Names
			    	$terms = get_the_terms( $post->ID, 'academicdepartment' );
			    	    if ( $terms && ! is_wp_error( $terms ) ) : 
			    	    	$dept_name_array = array();
			    	    foreach ( $terms as $term ) {
			    	        $dept_name_array[] = $term->name;
			    	    }
			    	    $dept_name = join( ", ", $dept_name_array ); ?>
			    	    Affiliations: 
			    	<?php echo $dept_name; endif;?>&nbsp;
			    	<?php //Get the Affiliation Names
							$terms_2 = get_the_terms( $post->ID, 'affiliation' );
							    if ( $terms_2 && ! is_wp_error( $terms_2 ) ) : 
							    	$affil_name_array = array();
							    foreach ( $terms_2 as $term_2 ) {
							        $affil_name_array[] = $term_2->name;
							    }
							    $affil_name = join( ", ", $affil_name_array );
							echo $affil_name; endif;?>
			</h6>
			
			<?php if ( get_post_meta($post->ID, 'ecpt_award_name', true) ) : ?>
			    <h5 class="black"><?php echo get_post_meta($post->ID, 'ecpt_award_name', true); ?></h5>
			<?php endif; ?>
		</div>
		<div class="row">
			<?php if ( has_post_thumbnail() ) { the_post_thumbnail('slider', array('class' => 'floatleft')); } ?>
			<h5>Project Description</h5>
			<?php the_content(); ?>
		</div>
		<div class="row">
			<?php if ( get_post_meta($post->ID, 'ecpt_article_list', true) ) : ?>
			<div class="six columns no-gutter">
				<h5>Articles and Related Links</h5>
					<div class="links_list">
						<?php echo get_post_meta($post->ID, 'ecpt_article_list', true); ?>
					</div>
			</div>
			<?php endif; ?>
			<?php if ( get_post_meta($post->ID, 'ecpt_video', true) || get_post_meta($post->ID, 'ecpt_research_pdf', true)) : ?>
				<div class="six columns no-gutter">
					<h5>Multimedia</h5>
					<div class="links_list">
					<?php if ( get_post_meta($post->ID, 'ecpt_research_pdf', true) ) : ?>
						<p class="bold"><a href="<?php echo get_post_meta($post->ID, 'ecpt_research_pdf', true); ?>">Download research materials</a></p>
					<?php endif; ?>
					<?php if ( get_post_meta($post->ID, 'ecpt_video', true) ) : ?>
						<p class="bold"><a href="#" data-reveal-id="modal_research_video"><span class="icon-video"></span>Watch research video</a></p>
					<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
<?php endwhile; endif; ?>
	</section>

</div>
<?php if ( get_post_meta($post->ID, 'ecpt_video', true) ) : ?>
		<div id="modal_research_video" class="reveal-modal large black_bg">
			<div class="flex-video">
				<?php $video_link = get_post_meta($post->ID, 'ecpt_video', true);
					global $wp_embed;
					$post_embed = $wp_embed->run_shortcode('[embed]' . $video_link . '[/embed]');
					echo $post_embed;
				?>
			</div>
			<a class="close-reveal-modal">&#215;</a>
		</div>	
<?php endif; ?>
<?php get_footer(); ?>