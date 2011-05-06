<div class="content left w600">
	
	<div class="pads">
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="post">
		
			<h2><?php the_title(); ?></h2>
	
			<div class="entry">
				<?php the_content(); ?>
			</div>
			
			<div class="clear"></div>
			
			<div class="meta">
				<p>Maintained by <?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?></p>
				<p>Last updated at <?php the_modified_time( 'g:i a l, M. jS, Y' ); ?></p>
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
			
		</div><!-- END .post -->
	
		<?php endwhile ; endif; ?>
	
	</div><!-- END .entry -->

</div><!-- END .content -->