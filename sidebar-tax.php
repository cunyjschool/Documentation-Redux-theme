<div class="sidebar right w300">
	<?php
		$term = get_queried_object();
		$taxonomy = get_taxonomy( $term->taxonomy );
	?>
	<?php if ( !is_home() && !is_404() && !is_search() ) { ?>
		<div class="widget search">
			<h4>Search </h4>
			<div class="search no-bottom-corners paper"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
		</div>
	<?php } ?>
	
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