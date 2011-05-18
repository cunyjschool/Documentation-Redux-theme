<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="post pads">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<h2><?php the_title() ?></h2>
					
					<div class="meta no-border">
						<p>By <?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?>&nbsp;&nbsp;&nbsp;Published <?php docredux_timestamp(); ?></p>
					</div><!-- END .meta -->
					
					<div class="entry">
						<?php the_content() ?>
					</div>
					
					<div class="clear"></div>
					
					<div class="meta">
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
