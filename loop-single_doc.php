<div class="content left w600">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="post">
		
			<h2><?php the_title(); ?></h2>
	
			<div class="entry">
				<?php the_content(); ?>
			</div>
			
			<div class="clear"></div>
			
			<div class="cant-find-anything">
				<h4>Can't find what you're looking for?</h4>
				<ul class="paper no-bottom-corners">
					<li><a href="<?php bloginfo('url') ?>/documentation/">Browse all documentation &rarr;</a></li>
					<li><a href="http://help.journalism.cuny.edu/">Submit a support ticket &rarr;</a></li>
				</ul>
			</div><!-- END .widget -->
			
		</div><!-- END .post -->
	
	<?php endwhile ; endif; ?>

</div><!-- END .content -->