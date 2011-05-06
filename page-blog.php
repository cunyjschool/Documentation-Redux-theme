<?php
/*
Template Name: Page - Blog
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive pads">
			
					<h2>Tech Blog</h2>			

			  		<?php 
                        $args=array(
                          'post_type' => 'post'
                        );
                        $temp = $wp_query;
                        $blog_posts = new WP_Query($args); 

                        if ( $blog_posts->have_posts() ) :

                        while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>

						<div class="doc-index" id="post-<?php the_ID(); ?>">

							<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
							<?php the_excerpt(); ?>
        					<?php if ( has_post_thumbnail()) { 	   
        					   the_post_thumbnail(  'thumbnail', array('class' => 'avatar') ); 
        					}?>
                            
                            <div class="clear"></div>

							<div class="meta">
								<?php 
									edit_post_link('Edit this post', '', ' — ');
									
									echo get_the_term_list( $post->ID, 'docredux_courses', '', ', ', '' );
									echo get_the_term_list( $post->ID, 'docredux_topics', ', ', ', ', '' );
									echo get_the_term_list( $post->ID, 'docredux_hardware', ', ', ', ', '' );
									echo get_the_term_list( $post->ID, 'docredux_software', ', ', ', ', '' );
									echo get_the_term_list( $post->ID, 'docredux_wpthemes', ', ', ', ', '' );
									echo get_the_term_list( $post->ID, 'docredux_wpplugins', ', ', ', ', '' );
								?>
							</div><!-- END .meta -->

						</div><!-- END - .doc-index -->

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
