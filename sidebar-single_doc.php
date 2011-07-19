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
			<p><label class="float-left">Maintained:</label> <span><?php if ( function_exists( 'coauthors_posts_links' ) ) { coauthors_posts_links(); } else { the_author_posts_link(); } ?></span></p>
			<p><label class="float-left">Updated:</label> <?php docredux_timestamp( false, 'modified' ); ?></p>
		<?php if ( $contexts = get_the_term_list( $post->ID, 'docredux_contexts', '', ', ', '' ) ) : ?>
			<p><label class="float-left">Contexts:</label> <span><?php echo $contexts; ?></span></p>
		<?php endif; ?>
		<?php if ( $courses = get_the_term_list( $post->ID, 'docredux_courses', '', ', ', '' ) ) : ?>
			<p><label class="float-left">Courses:</label> <span><?php echo $courses; ?></span></p>
		<?php endif; ?>
		<?php if ( $topics = get_the_term_list( $post->ID, 'docredux_topics', '', ', ', '' ) ) : ?>
			<p><label class="float-left">Topics:</label> <span><?php echo $topics; ?></span></p>
		<?php endif; ?>
		<?php if ( $hardware = get_the_term_list( $post->ID, 'docredux_hardware', '', ', ', '' ) ) : ?>
			<p><label class="float-left">Hardware:</label> <span><?php echo $hardware; ?></span></p>
		<?php endif; ?>
		<?php if ( $software = get_the_term_list( $post->ID, 'docredux_software', '', ', ', '' ) ) : ?>
			<p><label class="float-left">Software:</label> <span><?php echo $software; ?></span></p>
		<?php endif; ?>
		<?php if ( $wpthemes = get_the_term_list( $post->ID, 'docredux_wpthemes', '', ', ', '' ) ) : ?>
			<p><label class="float-left">WordPress themes:</label> <span><?php echo $wpthemes; ?></span></p>
		<?php endif; ?>
		<?php if ( $wpplugins = get_the_term_list( $post->ID, 'docredux_wpplugins', '', ', ', '' ) ) : ?>
			<p><label class="float-left">WordPress plugins:</label> <span><?php echo $wpplugins; ?></span></p>
		<?php endif; ?>
		</div><!-- END .no-bottom-corners -->
	</div><!-- END .widget -->
		
</div><!-- END .sidebar -->