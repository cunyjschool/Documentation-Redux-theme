<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive">
			
				<h2>Search Results</h2>

				<div class="search paper no-corners">
					<?php include (TEMPLATEPATH . '/searchform.php'); ?>				
				</div>					

		  		<?php if ( have_posts() ) : ?>
			
				<div class="search-results-total">Showing <?php echo $wp_query->post_count; ?> of <?php echo $wp_query->found_posts; ?> results</div>

			 	<?php while ( have_posts() ) : the_post(); ?>
				
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

					</div><!-- END - .post -->

				<?php endwhile; ?>

				<?php docredux_pagination(); ?>

				<?php else : ?>
				    
					<div class="message info">Sorry, but we don't have anything that matches your query. Please try a different search!</div>

				<?php endif; ?>
			
			</div><!-- END .archive -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
