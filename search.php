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

					<div class="staff-index post" id="post-<?php the_ID(); ?>">

						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						
						<div class="entry">
							<?php if ( has_post_thumbnail()) { 	   
	       					   the_post_thumbnail(  array(60,60), array('class' => 'avatar')); 
	       					}?>
							<?php the_excerpt() ?>
						</div>
       					
       					<div class="meta">
							Published <?php docredux_timestamp(); ?>
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
									echo ' and relates to ' . rtrim( $all_terms, ', ' );
								}
							?>
							<?php edit_post_link( 'Edit', ' - ', '' ); ?>
						</div><!-- END .meta -->

					</div><!-- END - .staff-index -->

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
