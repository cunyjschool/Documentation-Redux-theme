<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="entry pads">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<h2><?php the_title() ?></h2>
					
					<?php the_content() ?>
					
					<div class="clear"></div>
			
				<?php endwhile ; endif; ?>
			
			</div><!-- END .entry -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>

