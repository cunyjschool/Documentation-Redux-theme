<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive pads">
			
				<h2>Search Results</h2>			

		  		<?php if ( have_posts()) : ?>

			 	<?php while (have_posts()) : the_post(); ?>

					<div class="staff-index" id="post-<?php the_ID(); ?>">

						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						
						<div class="entry">
							<?php the_excerpt() ?>
						</div>

						<?php if ( has_post_thumbnail()) { 	   
       					   the_post_thumbnail(  array(60,60), array('class' => 'avatar')); 
       					}?>
       					
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

					</div><!-- END - .staff-index -->

				<?php endwhile; ?>

					<div class="navigation">
						<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
						<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
					</div>

				<?php else : ?>
				    
                    <br />
					<h4 class="">Sorry, but we don't have anything that matches your query. Please try a different search!</h4>
					<div class="search paper no-corners">
        				<?php include (TEMPLATEPATH . '/searchform.php'); ?>				
        			</div>

				<?php endif; ?>
			
			</div><!-- END .archive -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
