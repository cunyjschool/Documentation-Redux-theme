<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive pads">
			
				<h2>Archive</h2>			

		  		<?php if ( have_posts()) : ?>

			 	<?php while (have_posts()) : the_post(); ?>

					<div class="post-index" id="post-<?php the_ID(); ?>">

						<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>

						<?php the_excerpt(); ?>
						<?php if ( has_post_thumbnail()) { 	   
       					   the_post_thumbnail( 'thumbnail', array('class' => 'avatar') ); 
       					}?>

					</div><!-- END - .post-index -->

				<?php endwhile; ?>

					<div class="navigation">
						<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
						<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
					</div>

				<?php else : ?>

					<h4 class="center">Beep beep boop beep! Does not compute!</h4>
					<p class="center">Sorry, but you are looking for something that isn't here. Try a search!</p>

				<?php endif; ?>
			
			</div><!-- END .archive -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
