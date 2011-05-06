<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="pads">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<h2><?php the_title(); ?></h2>
			
					<div class="entry">
						<?php the_content(); ?>
					</div>
					
					<div class="clear"></div>
					
					<div class="meta">
						<p>Maintained by <?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?></p>
						<p>Last updated at <?php the_modified_time( 'g:i a l, M. jS, Y' ); ?></p>
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
						<?php edit_post_link( 'Edit this documentation', '<p>', '</p>' ); ?>
					</div><!-- END .meta -->
					
					
					<div class="entry-footer paper no-corners pads">
						<h4>Related documentation</h4>
						<?php
						$backup = $post;
						$found_none = '<p>No related documentation found.</p>';
						$taxonomy = 'docredux_hardware';
						$tax_args = array('orderby' => 'none');
						$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);
						if ($tags) {
							foreach ($tags as $tag) {
								$args = array(
									'post__not_in' => array($post->ID),
									'post_type' => array('docredux_doc','post'),
									'showposts'=> -1,
								);
								$my_query = null;
								$my_query = new WP_Query($args);
								if( $my_query->have_posts() ) { ?>
									<ul><?php 
									while ($my_query->have_posts()) : $my_query->the_post(); ?>
										<li><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
									<?php $found_none = '';
								endwhile;
								}
							}
						}
						if ($found_none) {
						echo $found_none;
						}
						$post = $backup;
						wp_reset_query();
						?>
					</div>
			
				<?php endwhile ; endif; ?>
			
			</div><!-- END .entry -->

		</div><!-- END .content -->
	
		<?php get_sidebar('documentation'); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
