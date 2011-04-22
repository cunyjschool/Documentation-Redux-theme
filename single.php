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
			
					<?php the_content() ?>
					
					<div class="entry-footer paper no-corners pads">
						<h4>Related posts</h4>
						<?php
						$tags = wp_get_post_tags($post->ID);
						if ($tags) {
							$tag_ids = array();
							foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

							$args=array(
								'tag__in' => $tag_ids,
								'post__not_in' => array($post->ID),
								'showposts'=>5, // Number of related posts that will be shown.
							);
							$my_query = new wp_query($args);
							if( $my_query->have_posts() ) {
								while ($my_query->have_posts()) {
									$my_query->the_post();
								?>
									<li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
								<?php
								}
								echo '</ul>';
							}
						}
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
