<div class="sidebar right w300">
	
	<div class="widget search">
		<h4>Search </h4>
		<div class="search no-bottom-corners paper"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
	</div><!-- END .widget -->
	
	<div class="widget cant-find">
		<h4>Can't find what you're looking for?</h4>
		<ul class="paper no-bottom-corners">
			<li><a href="<?php bloginfo('url') ?>/documentation/">Browse all documentation</a></li>
			<li><a href="http://help.journalism.cuny.edu/">Submit a support ticket</a></li>
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
			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
			<li class="post">
				<h5><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h5>
				<div class="meta"><?php docredux_timestamp(); ?></div>
			</li>
    		<?php endwhile; else: ?>
			<p>There are currently no related posts.</p>
			<?php endif; ?>
			<p class="see-all"><a href="<?php bloginfo('url') ?>/tech-blog/">See all &rarr;</a></p>
		</div>
	</div><!-- END .widget -->
		
</div><!-- END .sidebar -->