<?php
/*
Template Name: Page - Services
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content">
			
			<div class="entry">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<h2><?php the_title() ?></h2>
					
					<div class="meta">
						<?php 
							edit_post_link('Edit this post', '', ' — ');

 							the_time('l, F jS, Y');
							echo get_the_term_list( $post->ID, 'docredux_courses', ' — ', ', ', '' );
							echo get_the_term_list( $post->ID, 'docredux_topics', ', ', ', ', '' );
							echo get_the_term_list( $post->ID, 'docredux_hardware', ', ', ', ', '' );
							echo get_the_term_list( $post->ID, 'docredux_software', ', ', ', ', '' );
							echo get_the_term_list( $post->ID, 'docredux_wpthemes', ', ', ', ', '' );
							echo get_the_term_list( $post->ID, 'docredux_wpplugins', ', ', ', ', '' );
						?>
					</div><!-- END .meta -->	
			
					<?php the_content() ?>
							
				<?php endwhile ; endif; ?>
			
			</div><!-- END .entry -->

		</div><!-- END .content -->
		
	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>