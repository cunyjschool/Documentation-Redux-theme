<div class="footer">
	<div class="container">
		<div class="w600 posts left">
			<h3>Recent blog posts</h3>
			<?php
				$args = array(
                    'post_type' => 'post',
					'showposts' => 3
				);
				$news_posts = new WP_Query( $args ); ?>
			<ul>
	  		<?php if ( $news_posts->have_posts() ) : ?>
			<?php while ( $news_posts->have_posts() ) : $news_posts->the_post(); ?>
				<li>
					<?php if ( has_post_thumbnail()) { 	   
					   the_post_thumbnail(  array(60,60), array('class' => 'avatar')); 
					}?>
					<a href="<?php the_permalink() ?>"><h4 class="left"><?php the_title(); ?></h4></a><span>&nbsp;&mdash; <?php the_time( 'l, M. jS, Y' ); ?></span><br />
					<?php the_excerpt() ?>
				</li>
	    	<?php endwhile; else: ?>
				<li>There are currently no blog posts.</li>
			<?php endif; ?>
				<li><a href="<?php bloginfo('url') ?>/tech-blog/">More blog posts &rarr;</a></li>
			</ul>

		</div>
		
		<?php /*
	
		<div class="w300 events right">
			<h4>Upcoming Events</h4>
			<ul>
				<li><a href="#">Foobar Event</a>&mdash; Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
				<li><a href="#">So Many Events</a>&mdash; Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
				<li><a href="#">Event Bonanza</a>&mdash; Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
				<li><a href="#">Too Many Events?</a>&mdash; Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
				<li><a href="#">How Many Events is Too Many Events, I ask You?</a>&mdash; Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
				<li><a href="<?php bloginfo('url') ?>/staff/">More events &rarr;</a></li>
			</ul>
		</div>
		
		*/ ?>
	</div><!-- END .container -->
	<div class="clear"></div>
</div><!-- END .footer -->

</body>
</html>