<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive">
			
					<h2>Documentation Archive</h2>			

			  		<?php if ( have_posts()) : ?>

				 	<?php while (have_posts()) : the_post(); ?>

						<div class="doc-index" id="post-<?php the_ID(); ?>">

							<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>

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

							<!-- <?php the_excerpt(); ?> -->

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