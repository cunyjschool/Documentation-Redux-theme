<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive pads">
			
					<h2>Search Results</h2>			

			  		<?php if ( have_posts()) : ?>

				 	<?php while (have_posts()) : the_post(); ?>

						<div class="staff-index" id="post-<?php the_ID(); ?>">

							<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
							<?php the_excerpt() ?>

							<?php if ( has_post_thumbnail()) { 	   
        					   the_post_thumbnail(  array(60,60), array('class' => 'avatar')); 
        					}?>

						</div><!-- END - .staff-index -->

				<?php endwhile; ?>

					<div class="navigation">
						<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
						<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
					</div>

				<?php else : ?>
				    
                    <br />
					<h4 class="">Sorry, but we don't have anything that matches your query. Please try a different search!</h4>

				<?php endif; ?>
			
			</div><!-- END .archive -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
