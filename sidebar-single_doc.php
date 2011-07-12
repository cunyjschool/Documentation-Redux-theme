<div class="sidebar right w300">
	<?php
		$term = get_queried_object();
		$taxonomy = get_taxonomy( $term->taxonomy );
	?>
	<div class="widget search">
		<h4>Search</h4>
		<div class="search no-bottom-corners paper"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
	</div>
	
	<div class="widget doc-meta">
		
		<h4><?php _e( 'About This Document' ); ?></h4>
		
		<div class="paper no-bottom-corners">
			<p><label>Maintained:</label> <?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?></p>
			<p><label>Updated:</label> <?php docredux_timestamp( false, 'modified' ); ?></p>
		<?php if ( $contexts = get_the_term_list( $post->ID, 'docredux_contexts', '', ', ', '' ) ) : ?>
			<p><label>Contexts:</label> <?php echo $contexts; ?></p>
		<?php endif; ?>
		<?php if ( $courses = get_the_term_list( $post->ID, 'docredux_courses', '', ', ', '' ) ) : ?>
			<p><label>Courses:</label> <?php echo $courses; ?></p>
		<?php endif; ?>
		<?php if ( $topics = get_the_term_list( $post->ID, 'docredux_topics', '', ', ', '' ) ) : ?>
			<p><label>Topics:</label> <?php echo $topics; ?></p>
		<?php endif; ?>
		<?php if ( $hardware = get_the_term_list( $post->ID, 'docredux_hardware', '', ', ', '' ) ) : ?>
			<p><label>Hardware:</label> <?php echo $hardware; ?></p>
		<?php endif; ?>
		<?php if ( $software = get_the_term_list( $post->ID, 'docredux_software', '', ', ', '' ) ) : ?>
			<p><label>Software:</label> <?php echo $software; ?></p>
		<?php endif; ?>
		<?php if ( $wpthemes = get_the_term_list( $post->ID, 'docredux_wpthemes', '', ', ', '' ) ) : ?>
			<p><label>WordPress themes:</label> <?php echo $wpthemes; ?></p>
		<?php endif; ?>
		<?php if ( $wpplugins = get_the_term_list( $post->ID, 'docredux_wpplugins', '', ', ', '' ) ) : ?>
			<p><label>WordPress plugins:</label> <?php echo $wpplugins; ?></p>
		<?php endif; ?>
		</div><!-- END .no-bottom-corners -->
	</div><!-- END .widget -->
		
</div><!-- END .sidebar -->