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
	
	<div class="widget blog-posts">
		<h4>Blog Posts for <?php echo $term->name; ?></h4>
		<div class="paper no-bottom-corners">
		
		<?php
		
        	$args = array(
        		'nopaging' => true,
        		'posts_per_page' => '10',
        		'post_type' => 'post',
        		'tax_query' => array(
        			array(
        				'taxonomy' => $term->taxonomy,
        				'field' => 'slug',
        				'terms' => $term->slug,
        			),
        		),
        	);
			
			$posts = new WP_Query( $args );
			
			if ( $posts->have_posts() ) : ?>
			<ul class="all-posts">
			<?php while ( $posts->have_posts() ) : $posts->the_post(); 
				$post_format = get_post_format();
				if ( false === $post_format ) {
					$post_format = 'standard';
				}
			?>
			<li class="post sidebar-post-format-<?php echo $post_format ?>">
				<?php if ( $post_format == 'aside' || $post_format == 'status' ) { ?>
					<?php the_content() ?>
					<div class="meta">Published <a href="<?php the_permalink(); ?>"><?php docredux_timestamp(); ?></a></div>					
				<?php } else { ?>
					<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
					<div class="meta">Published <?php docredux_timestamp(); ?></div>
				 <?php } ?>	
			</li>
    		<?php endwhile; else: ?>
			<li>There are currently no blog posts.</li>
			<?php endif; ?>
			</ul>
			<p class="see-all"><a href="<?php bloginfo('url') ?>/tech-blog/">See all &rarr;</a></p>
		</div>
			
		
	</div><!-- END .widget.blog-posts -->
		
</div><!-- END .sidebar -->