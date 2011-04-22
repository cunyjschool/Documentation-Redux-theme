<?php
/**
 * @todo This is a archive page for a WordPress plugin term. Show all related content
 */

?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive pads">
			
					<h2><?php $terms = get_the_term_list( $post->ID, 'docredux_wpplugins', '', ', ', '' ); echo strip_tags( $terms ); ?></h2>			

			  		<?php if ( have_posts()) : ?>

				 	<?php while (have_posts()) : the_post(); ?>

						<div class="excerpt" id="post-<?php the_ID(); ?>">

							<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>

							<div class="meta">
								<?php 
									global $current_user;	
									get_currentuserinfo();
									if ($current_user->user_level == 10 ) {
										edit_post_link('Edit this post', '', ' — ');
									}
		 							the_time('l, F jS, Y');
									echo ' &mdash; ';
									echo get_the_term_list( $post->ID, 'docredux_courses', '', ', ', '' );
									echo get_the_term_list( $post->ID, 'docredux_topics', ', ', ', ', '' );
									echo get_the_term_list( $post->ID, 'docredux_hardware', ', ', ', ', '' );
									echo get_the_term_list( $post->ID, 'docredux_software', ', ', ', ', '' );
									echo get_the_term_list( $post->ID, 'docredux_wpthemes', ', ', ', ', '' );
									echo get_the_term_list( $post->ID, 'docredux_wpplugins', ', ', ', ', '' );
								?>
							</div><!-- END .meta -->

							<?php the_excerpt(); ?>

						</div><!-- END - .post -->

				<?php endwhile; ?>

					<div class="navigation">
						<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
						<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
					</div>

				<?php else : ?>

					<h4 class="center">Beep beep boop beep! Does not compute!</h4>
					<p class="center">Sorry, but you are looking for something that isn't here. Try a search!</p>

				<?php endif; ?>
			
			</div><!-- END .archive -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>

