<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
				<?php
					$post_format = get_post_format();
					if ( false == $post_format ) {
						$post_format == 'standard';
					}
				?>
			
				<div class="post post-format-<?php echo $post_format; ?> pads">
							
					<?php if ( $post_format == 'standard' ){ ?>
					
						<h2><?php the_title() ?></h2>
						
						<div class="entry">
							<?php the_content() ?>
						</div>
					
					<?php } else { ?>
					
						<h3>
							<?php the_excerpt() ?>
						</h3>
						
					<?php } ?>
					
					<div class="clear"></div>
					
					<div class="meta">
						<p>By <?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?> <?php edit_post_link( 'Edit', " - " ); ?></p>
						<p>Published at <?php the_time( 'g:i a l, M. jS, Y' ); ?></p>
						<?php if ( $contexts = get_the_term_list( $post->ID, 'docredux_contexts', '', ', ', '' ) ) : ?>
							<p>Contexts: <?php echo $contexts; ?></p>
						<?php endif; ?>
						<?php if ( $courses = get_the_term_list( $post->ID, 'docredux_courses', '', ', ', '' ) ) : ?>
							<p>Courses: <?php echo $courses; ?></p>
						<?php endif; ?>
						<?php if ( $topics = get_the_term_list( $post->ID, 'docredux_topics', '', ', ', '' ) ) : ?>
							<p>Topics: <?php echo $topics; ?></p>
						<?php endif; ?>
						<?php if ( $hardware = get_the_term_list( $post->ID, 'docredux_hardware', '', ', ', '' ) ) : ?>
							<p>Hardware: <?php echo $hardware; ?></p>
						<?php endif; ?>
						<?php if ( $software = get_the_term_list( $post->ID, 'docredux_software', '', ', ', '' ) ) : ?>
							<p>Software: <?php echo $software; ?></p>
						<?php endif; ?>
						<?php if ( $wpthemes = get_the_term_list( $post->ID, 'docredux_wpthemes', '', ', ', '' ) ) : ?>
							<p>WordPress themes: <?php echo $wpthemes; ?></p>
						<?php endif; ?>
						<?php if ( $wpplugins = get_the_term_list( $post->ID, 'docredux_wpplugins', '', ', ', '' ) ) : ?>
							<p>WordPress plugins: <?php echo $wpplugins; ?></p>
						<?php endif; ?>
					</div><!-- END .meta -->
			
				<?php endwhile ; endif; ?>
			
			</div><!-- END .entry -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
