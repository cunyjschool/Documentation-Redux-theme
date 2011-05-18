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
					
					<div class="meta no-border">
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
					</div>
					
					<div class="meta">
						<p>Updated <?php docredux_timestamp( false, 'modified' ); ?></p>						
					</div><!-- END .meta -->
			
				<?php endwhile ; endif; ?>
				
				<div class="recently-published entry-footer paper pads">
					
					<h4>Recently Published by <?php the_author(); ?></h4>
					<?php

						$args = array(
							'posts_per_page' => '8',
							'post_type' => array(
								'post',
								'docredux_doc',
							),
						);
						$content = new WP_Query( $args );

					?>
					<ul class="all-content">			
					<?php if ( $content->have_posts() ): ?>
					<?php while ( $content->have_posts() ): $content->the_post(); ?>
						<li>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						</li>
					<?php endwhile; ?>		
					<?php else: ?>
						<li><div class="message info">No content yet.</div></li>
					<?php endif; ?>
					</ul><!-- END .all-content -->
					<p class="see-all"><a href="<?php echo get_author_posts_url( $post->post_author ); ?>">See all &rarr;</a></p>
				</div><!-- END .widget -->
			
			</div><!-- END .entry -->

		</div><!-- END .content -->
	
		<?php get_sidebar( 'single_staff' ); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>

