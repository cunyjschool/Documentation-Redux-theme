<div class="content left w600">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<div class="post">
		
			<h2><?php the_title(); ?></h2>
	
			<div class="entry">
				<?php the_content(); ?>
			</div>
			
			<div class="clear"></div>
			
		</div><!-- END .post -->
	
	<?php endwhile ; endif; ?>

</div><!-- END .content -->