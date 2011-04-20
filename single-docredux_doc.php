<?php
/**
 * @todo This is a single documentation page
 */

?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="entry">
			
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				
					<h3><?php the_title() ?></h3>
					
					<div class="meta">
						<span><?php the_time('l, F jS, Y') ?></span> &mdash;
						<span><?php get_the_term_list( $post->ID, 'docredux_courses', '', ', ', '' ) ?></span>
					</div><!-- END .meta -->	
			
					<?php the_content() ?>
			
				<?php endwhile ; endif; ?>
			
			</div><!-- END .entry -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
