<?php
/*
Template Name: Full Width
*/
?>
<?php get_header(); ?>
<div class="row wrapper radius10" id="opp">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="twelve columns radius10 offset-topgutter">
		<?php locate_template('parts-nav-breadcrumbs.php', true, false); ?>	
		<section>
				<h2><?php the_title();?></h2>
					<?php if ( has_post_thumbnail()) { ?> 
						<div class="floatright">
							<?php the_post_thumbnail('full',array('class'	=> "radius-topleft")); ?>
						</div>
					<?php } ?>
				<?php the_content(); ?>
		</section>
	</div>	<!-- End main content (left) section -->
<?php endwhile; endif; ?>	
</div> 
<?php get_footer(); ?> 