<?php
/*
Template Name: Page - Hardware
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive pads">
			
					<h2>Hardware</h2>			

			  		<?php
						$args = array(
							'post_type' => 'docredux_doc',
							'showposts' => -1
						);
						$news_posts = new WP_Query( $args ); ?>
			  		<?php if ( $news_posts->have_posts() ) : ?>
					<?php while ( $news_posts->have_posts() ) : $news_posts->the_post(); ?>
						<div class="doc-index">
							<?php echo get_avatar( get_the_author_meta(), '60' ); ?>
							<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
						</div>
			    	<?php endwhile; else: ?>
						<p>There is currently no hardware documentation.</p>
					<?php endif; ?>
			
			</div><!-- END .archive -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
