<div class="sidebar right w300">
	
	<div class="widget">
		<h4>Search </h4>
		<div class="search no-bottom-corners paper"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
	</div><!-- END .widget -->
	
	<div class="widget">
		<h4>Can't find what you're looking for?</h4>
		<ul class="paper no-bottom-corners">
			<li><a href="<?php bloginfo('url') ?>/documentation/">Browse all documentation</a></li>
			<li><a href="http://help.journalism.cuny.edu/">Submit a support ticket</a></li>
		</ul>
	</div><!-- END .widget -->
	
	<div class="widget">
		<h4>Related Documentation</h4>
		<div class="paper no-bottom-corners">
			<?php
        		$taxonomy = 'docredux_topics';
        		$param_type = 'docredux_topics';
        		$tax_args=array('orderby' => 'date');
        		$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);

				foreach ($tags as $tag) {

        			$args = array(
        			    $param_type => $tag->slug,
        			    'post_type' => 'docredux_doc',
        			    'showposts'=> 4,
        			);
        				
    			    $docs = new WP_Query( $args );

                    if ( $docs->have_posts() ) :
			        while ( $docs->have_posts() ) : $docs->the_post(); 
			?>
				<div class="on-duty">
					
					<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
					<?php the_excerpt(); ?>
				</div>
	    	<?php endwhile; else: ?>
				<p>There is currently no related documentation.</p>
			<?php endif; } ?>
				<p><a href="<?php bloginfo('url') ?>/documentation/">Browse documentation &rarr;</a></p>
		</div>
	</div><!-- END .widget -->
	
	<div class="widget">
		<h4>Related Blog Posts</h4>
		<div class="paper no-bottom-corners">
			<?php
        		$taxonomy = 'docredux_topics';
        		$param_type = 'docredux_topics';
        		$tax_args=array('orderby' => 'date');
        		$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);

				foreach ($tags as $tag) {

        			$args = array(
        			    $param_type => $tag->slug,
        			    'post_type' => 'post',
        			    'showposts'=> 4,
        			);

    			    $posts = new WP_Query( $args );

                    if ( $posts->have_posts() ) :
			        while ( $posts->have_posts() ) : $posts->the_post(); 
			?>
				<div class="on-duty">
					
					<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
					<?php the_excerpt(); ?>
				</div>
	    	<?php endwhile; else: ?>
				<p>There are currently no related posts.</p>
			<?php endif; } ?>
				<p><a href="<?php bloginfo('url') ?>/tech-blog/">See all blog posts &rarr;</a></p>
		</div>
	</div><!-- END .widget -->
		
</div><!-- END .sidebar -->