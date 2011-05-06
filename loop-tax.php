<div class="content left w600">
	
	<div class="archive pads">
		
		<?php
			$term = get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );
		?>
		
		<h2 class="term-name"><?php echo $term->name; ?></h2>
		
		<?php if ( !empty( $term->description ) ): ?>
			<div class="term-description"><?php echo $term->description; ?></div>
		<?php endif; ?>

	  	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">

				<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
				<?php the_excerpt(); ?>

				<div class="meta">
					<?php 
						edit_post_link('Edit this post', '', ' — ');
						
						the_time('l, F jS, Y');
						echo get_the_term_list( $post->ID, 'docredux_courses', ' — ', ', ', '' );
						echo get_the_term_list( $post->ID, 'docredux_topics', ', ', ', ', '' );
						echo get_the_term_list( $post->ID, 'docredux_hardware', ', ', ', ', '' );
						echo get_the_term_list( $post->ID, 'docredux_software', ', ', ', ', '' );
						echo get_the_term_list( $post->ID, 'docredux_wpthemes', ', ', ', ', '' );
						echo get_the_term_list( $post->ID, 'docredux_wpplugins', ', ', ', ', '' );
					?>
				</div><!-- END .meta -->

			</div><!-- END - .post -->

		<?php endwhile; ?>

			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			</div>

		<?php else : ?>

			<h2 class="center">Beep beep boop beep! Does not compute!</h2>
			
			<p class="center">Sorry, but you are looking for something that isn't here. Try a search!</p>

		<?php endif; ?>
	
	</div><!-- END .archive -->

</div><!-- END .content -->