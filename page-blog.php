<?php
/*
Template Name: Page - Blog
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive">
			
				<h2>Tech Blog</h2>			

				<?php 
					   $args=array(
						 'post_type' => 'post'
					   );
					   $temp = $wp_query;
					   $blog_posts = new WP_Query($args); 

					   if ( $blog_posts->have_posts() ) :

					   while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>

						<?php
							$post_format = get_post_format();
							if ( false === $post_format ) {
								$post_format = 'standard';
							}
						?>
						
					<div class="post-index post post-format-<?php echo $post_format; ?>" id="post-<?php the_ID(); ?>">
						
						<?php if ( $post_format == 'aside' || $post_format == 'status' ): ?>
						
						<div class="entry">						
							<?php the_content() ?>
						</div>
							
						<?php else: ?>
							
							<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
							<div class="entry">
		       					<?php if ( has_post_thumbnail()) { 	   
		       					   the_post_thumbnail(  'thumbnail', array('class' => 'thumb float-left') ); 
		       					}?>						
							<?php the_excerpt(); ?>
							</div>
							
							<div class="clear"></div>
							
						<?php endif; ?>
						
						<div class="meta no-border">
							By <?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?> - 
							Published <a href="<?php the_permalink(); ?>"><?php docredux_timestamp(); ?></a>
							<?php 
								$all_terms = ''; 
								$all_terms .= get_the_term_list( $post->ID, 'docredux_courses', '', ', ', ', ' );
								$all_terms .= get_the_term_list( $post->ID, 'docredux_contexts', '', ', ', ', ' );								
								$all_terms .= get_the_term_list( $post->ID, 'docredux_topics', '', ', ', ', ' );
								$all_terms .= get_the_term_list( $post->ID, 'docredux_hardware', '', ', ', ', ' );
								$all_terms .= get_the_term_list( $post->ID, 'docredux_software', '', ', ', ', ' );
								$all_terms .= get_the_term_list( $post->ID, 'docredux_wpthemes', '', ', ', ', ' );
								$all_terms .= get_the_term_list( $post->ID, 'docredux_wpplugins', '', ', ', ', ' );
								if ( $all_terms ) {
									echo ' - ' . rtrim( $all_terms, ', ' );
								}
							?>
							<?php edit_post_link( 'Edit', ' - ', '' ); ?>
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
