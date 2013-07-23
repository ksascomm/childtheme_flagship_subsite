<?php
/*
Template Name: Research Profile Search Results
*/
?>
<?php get_header(); ?>

<div class="row sidebar_bg radius10" id="opp">
<?php locate_template('parts-nav-sidebar.php', true, false); ?>	
	<div class="eight columns pull-four wrapper radius-left offset-topgutter">
		
		<?php if(empty($_POST['keyword']) && empty($_POST['affiliation'])) {
					$query_args = array(
					'post_type' => 'profile',
					'posts_per_page' => '25',
					'paged' => $paged );
			}
			
			elseif(empty($_POST['keyword']) == false && empty($_POST['affiliation']) == false) {
					$keyword = $_POST['keyword'];
					$query_args = array(
					'post_type' => 'profile',
					'posts_per_page' => '25',
					's' => $keyword,
					'tax_query' => array(
						'relation' => 'OR',
						array(
						'taxonomy' => 'academicdepartment',
						'field' => 'slug',
						'terms' => $affiliation,
						),
						array(
						'taxonomy' => 'affiliation',
						'field' => 'slug',
						'terms' => $affiliation,
						)),
					'paged' => $paged );
			}
			
			elseif (empty($_POST['keyword']) == false) { 
					$keyword = $_POST['keyword'];
					$query_args = array(
					'post_type' => 'profile',
					'posts_per_page' => '25',
					's' => $keyword,
					'paged' => $paged
					);}
					
			elseif (empty($_POST['affiliation']) == false) { 
			  		$affiliation = $_POST['affiliation'];
			  		$query_args = array(
					'post_type' => 'profile',
					'posts_per_page' => '25',
					'tax_query' => array(
						'relation' => 'OR',
						array(
						'taxonomy' => 'academicdepartment',
						'field' => 'slug',
						'terms' => $affiliation,
						),
						array(
						'taxonomy' => 'affiliation',
						'field' => 'slug',
						'terms' => $affiliation,
						)),
					'paged' => $paged
					); } 

			$paged = (get_query_var('paged')) ? (int) get_query_var('paged') : 1;
			$research_search_results_query = new WP_Query($query_args);  	?>
					
		<section>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<h2><?php the_title();?></h2>
				<fieldset>
					<form method="post" action="<?php echo site_url('/results'); ?>">
						<div class="twelve columns">
						    <input type="text" name="keyword" placeholder="Search by name or keyword" />
						    <label class="bold inline">Affiliation:</label>
						    <select name="affiliation" class="inline" style="width: 70%;">
						    <option value="">Any Affiliation</option>
						    <?php $taxonomies = array('academicdepartment', 'affiliation'); 
						    $terms = get_terms($taxonomies, array(
						    			'hide_empty' => 1,
						    ));
									foreach ( $terms as $term ) {
										echo '<option value="' . $term->slug . '">' . $term->name . '</option>';
				        
										} ?>
						    </select> 
						    <input type="submit" class="icon-search" value="Search" />
						</div>
					</form>
				</fieldset>

				<?php the_content(); ?>
			<?php endwhile; endif; ?>
				<ul id="directory">
				<?php while ($research_search_results_query->have_posts()) : $research_search_results_query->the_post(); ?>
				<li class="person">
					<div class="row">
						<div class="eleven columns centered">
						<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><h4 class="no-margin"><?php the_title(); ?></h4></a>
						
						<h6 class="no-margin">
							<?php if ( get_post_meta($post->ID, 'ecpt_class_year', true) ) : ?><span class="attribute"><b>Year:&nbsp;</b><?php echo get_post_meta($post->ID, 'ecpt_class_year', true); ?></span><?php endif; ?>
							
							<?php if (has_term('','academicdepartment', $post->ID) == true || has_term('','affiliation', $post->ID) == true) { ?><span class="attribute"><b>Affiliations:</b> <?php } ?>
							<?php 	//Get the Academic Department Names
							$terms = get_the_terms( $post->ID, 'academicdepartment' );
							    if ( $terms && ! is_wp_error( $terms ) ) : 
							    	$dept_name_array = array();
							    foreach ( $terms as $term ) {
							        $dept_name_array[] = $term->name;
							    }
							    $dept_name = join( ", ", $dept_name_array );
							echo $dept_name; endif;
							//Get the Affiliation Names
							$terms_2 = get_the_terms( $post->ID, 'affiliation' );
							    if ( $terms_2 && ! is_wp_error( $terms_2 ) ) : 
							    	$affil_name_array = array();
							    foreach ( $terms_2 as $term_2 ) {
							        $affil_name_array[] = $term_2->name;
							    }
							    $affil_name = join( ", ", $affil_name_array );
							    	if (has_term('','academicdepartment', $post->ID) == true) { echo ','; } 
							echo ' ' . $affil_name; endif;
							?></span></h6>
							
							
							<?php if ( get_post_meta($post->ID, 'ecpt_article_list', true) || get_post_meta($post->ID, 'ecpt_research_pdf', true) || get_post_meta($post->ID, 'ecpt_video', true) ) : ?><h6 class="no-margin"><b>Multimedia:&nbsp;</b><?php endif; ?>
							
							<?php if ( get_post_meta($post->ID, 'ecpt_article_list', true) || get_post_meta($post->ID, 'ecpt_research_pdf', true) ) : ?><span class="icon-newspaper"></span><?php endif; ?>
							
							<?php if ( get_post_meta($post->ID, 'ecpt_video', true) ) : ?><span class="icon-video"></span><?php endif; ?>
						</h6>

						<?php if ( get_post_meta($post->ID, 'ecpt_award_name', true) ) : ?><p class="bold no-margin"><?php echo get_post_meta($post->ID, 'ecpt_award_name', true); ?></p><?php endif; ?>

						<?php if ( get_post_meta($post->ID, 'ecpt_pull_quote', true) ) : ?><p><b>Topic:&nbsp;</b><?php echo strip_tags(get_post_meta($post->ID, 'ecpt_pull_quote', true)); ?></p><?php endif; ?>
						
						
						</div>
					</div>
				</li>		
	<?php endwhile; ?>

				</ul>
			<div class="row">
			<?php flagship_pagination($research_search_results_query->max_num_pages); ?>		
		</div>
		</section>
	</div>	<!-- End main content (left) section -->
</div> 
<?php get_footer(); ?> 