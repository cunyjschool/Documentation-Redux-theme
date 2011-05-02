<div class="sidebar right w300">
	<?php if ( !is_home() ) { ?>
		<div class="widget">
			<h4>Search </h4>
			<div class="search no-bottom-corners paper"><?php include (TEMPLATEPATH . '/searchform.php'); ?></div>
		</div>
	<?php } ?>
	<div class="widget">
		<h4>Can't find what you're looking for?</h4>
		<ul class="paper no-bottom-corners">
			<li><a href="<?php bloginfo('url') ?>/documentation/">Browse all documentation</a></li>
			<li><a href="http://help.journalism.cuny.edu/">Submit a support ticket</a></li>
		</ul>
	</div>
	<div class="widget">
		<h4>Web team on duty</h4>
		<div class="paper no-bottom-corners">
			<?php
				$args = array(
					'post__not_in' => array($post->ID),
					'post_type' => 'docredux_staff',
					'showposts' => 4
					'order'    => 'ASC'
				);
				$staff = new WP_Query( $args ); ?>
	  		<?php if ( $staff->have_posts() ) : ?>
			<?php while ( $staff->have_posts() ) : $staff->the_post(); ?>
				<div class="on-duty">
					<?php if ( has_post_thumbnail()) { 	   
					   the_post_thumbnail(  array(60,60), array('class' => 'avatar')); 
					}?>
					<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
					<?php the_excerpt(); ?>
				</div>
	    	<?php endwhile; else: ?>
				<p>There are currently no staff members.</p>
			<?php endif; ?>
				<p><a href="<?php bloginfo('url') ?>/staff/">See all IT Staff &rarr;</a></p>
		</div>			
	</div>	
</div><!-- END .sidebar -->