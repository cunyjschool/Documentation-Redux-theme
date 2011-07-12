<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="post pads post-type-staff">
			
				<?php if ( have_posts()) : while ( have_posts()) : the_post(); ?>
					
					<?php if ( has_post_thumbnail() ) { 	   
						the_post_thumbnail( array(60,60), array('class' => 'avatar float-right') ); 
					} ?>					
				
					<h2><?php the_title(); ?><?php if ( $title = get_post_meta( get_the_id(), '_docredux_staff_title', true ) ) { echo '<span class="staff-title">' . $title . '</span>'; } ?></h2>
					
					<div class="entry">
						<?php the_content(); ?>
					</div>
			
				<?php endwhile ; endif; ?>
				
				<?php if ( $wordpress_user = get_post_meta( $post->ID, '_docredux_staff_wordpress_user', true ) ) : ?>
				
				<div class="recently-published">
					
					<h3>Recently published by <?php the_title(); ?></h3>
					<div class="paper no-bottom-corners">
					<?php

						$args = array(
							'posts_per_page' => '8',
							'post_type' => array(
								'post',
								'docredux_doc',
							),
							'author' => $wordpress_user,
						);
						$content = new WP_Query( $args );

					?>
					<ul class="all-content">			
					<?php if ( $content->have_posts() ): ?>
					<?php while ( $content->have_posts() ): $content->the_post();
						$post_format = get_post_format();
						if ( false === $post_format ) {
							$post_format = 'standard';
						}
					?>
						<li class="post-format-<?php echo $post_format; ?>">
							<?php if ( $post_format == 'aside' || $post_format == 'status' ) { ?>
								<?php the_content(); ?>
							<?php } else { ?>
								<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>				
							 <?php } ?>
							<div class="meta">
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
							</div>
						</li>
					<?php endwhile; ?>		
					<?php else: ?>
						<li><div class="message info">No content yet.</div></li>
					<?php endif; ?>
					</ul><!-- END .all-content -->
					<p class="see-all"><a href="<?php echo get_author_posts_url( $post->post_author ); ?>">See all &rarr;</a></p>
					</div>
					
				</div><!-- END .recently-published -->
				
				<?php endif; ?>
			
			</div><!-- END .entry -->

		</div><!-- END .content -->
	
		<?php get_sidebar( 'single_staff' ); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>

