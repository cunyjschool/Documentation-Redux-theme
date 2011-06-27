<?php
/*
Template Name: Page - Full Width
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content full">
			
			<div class="entry">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<h2><?php the_title() ?></h2>
					
					<div class="meta">
						<?php edit_post_link('Edit this post', '', ''); ?>
					</div><!-- END .meta -->	
			
					<?php the_content() ?>
							
				<?php endwhile ; endif; ?>
			
			</div><!-- END .entry -->

		</div><!-- END .content -->

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
