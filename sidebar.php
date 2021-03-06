<div class="sidebar right w300">
	
	<?php if ( !is_home() && !is_404() && !is_search() ) { ?>
		<div class="widget search">
			<h4>Search </h4>
			<div class="search no-bottom-corners paper"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
		</div>
	<?php } ?>
	
	<div class="widget cant-find">
		<h4>Can't find what you're looking for?</h4>
		<ul class="paper no-bottom-corners">
			<li><a href="<?php bloginfo('url') ?>/documentation/">Browse all documentation &rarr;</a></li>
			<li><a href="http://help.journalism.cuny.edu/">Submit a support ticket &rarr;</a></li>
		</ul>
	</div><!-- END .widget -->
	
	<div class="widget blog-posts">
		<h4>Recent Blog Posts</h4>
		<div class="paper no-bottom-corners">
		<?php
		
			$args = array(
				'posts_per_page' => '2',
				'post_type' => 'post',
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
				<?php } else { ?>
					<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
				 <?php } ?>	
				<div class="meta">Published <a href="<?php the_permalink(); ?>"><?php docredux_timestamp(); ?></a></div>				
			</li>
    		<?php endwhile; else: ?>
			<li>There are currently no blog posts.</li>
			<?php endif; ?>
			</ul>
			<p class="see-all"><a href="<?php bloginfo('url') ?>/tech-blog/">See all &rarr;</a></p>
		</div>
	</div><!-- END .widget.blog-posts -->
	
	<div class="widget documentation">
		<h4>Updated Documentation</h4>
		<div class="paper no-bottom-corners">
		<?php
		
			$args = array(
				'posts_per_page' => '5',
				'post_type' => 'docredux_doc',
				'orderby' => 'modified'
			);
			
			$documentation = new WP_Query( $args );
			
			if ( $documentation->have_posts() ) : ?>
			<ul class="all-documentation">
			<?php while ( $documentation->have_posts() ) : $documentation->the_post(); ?>
			<li class="post documentation">
				<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
				<div class="meta">Updated <a href="<?php the_permalink(); ?>"><?php docredux_timestamp( false, 'modified' ); ?></a></div>
			</li>
    		<?php endwhile; else: ?>
			<li>There are currently no documentation.</li>
			<?php endif; ?>
			</ul>
		</div>
	</div><!-- END .widget -->
		
</div><!-- END .sidebar -->