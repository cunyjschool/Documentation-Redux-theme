<?php
/**
 * @todo This is a single post
 */

?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="entry pads">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<h2><?php the_title() ?></h2>
							
					<?php the_content() ?>
					
					<div class="meta">
						<?php 
							global $current_user;	
							get_currentuserinfo();
							if ($current_user->user_level == 10 ) {
								edit_post_link('Edit this post', '', ' — ');
							}
 							the_time('l, F jS, Y');
							echo get_the_term_list( $post->ID, 'docredux_courses', ' — ', ', ', '' );
							echo get_the_term_list( $post->ID, 'docredux_topics', ', ', ', ', '' );
							echo get_the_term_list( $post->ID, 'docredux_hardware', ', ', ', ', '' );
							echo get_the_term_list( $post->ID, 'docredux_software', ', ', ', ', '' );
							echo get_the_term_list( $post->ID, 'docredux_wpthemes', ', ', ', ', '' );
							echo get_the_term_list( $post->ID, 'docredux_wpplugins', ', ', ', ', '' );
						?>
					</div><!-- END .meta -->
					
					<div class="entry-footer paper no-corners pads">
						<h4>Related documents</h4>
						<?php
						$backup = $post;
						$found_none = '<p>No related documents found.</p>';
						$taxonomy = 'docredux_courses';
						// $param_type = 'courses';
						$tax_args=array('orderby' => 'none');
						$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);
						if ($tags) {
							foreach ($tags as $tag) {
								$args=array(
									// "$param_type" => $tag->slug,
									'post__not_in' => array($post->ID),
									'post_type' => 'docredux_doc',
									'showposts'=> -1,
								);
								$my_query = null;
								$my_query = new WP_Query($args);
								if( $my_query->have_posts() ) { ?>
									<ul><?php 
									while ($my_query->have_posts()) : $my_query->the_post(); ?>
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
									<?php $found_none = '';
								endwhile;
								}
							}
						}
						if ($found_none) {
						echo $found_none;
						}
						$post = $backup;
						wp_reset_query();
						?>
					</div>
			
				<?php endwhile ; endif; ?>
			
			</div><!-- END .entry -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
