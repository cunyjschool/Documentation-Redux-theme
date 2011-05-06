<div class="content left w600">
	
	<div class="archive pads">
		
		<?php
			$term = get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );
		?>
		
		<h2 class="term-name"><a href="<?php bloginfo('url'); ?>/<?php echo docredux_get_term_base( $term ) . '/' . $term->slug . '/'; ?>"><?php echo $taxonomy->labels->name; ?></a>: <?php echo $term->name; ?></h2>
		
		<?php if ( !empty( $term->description ) ): ?>
			<div class="term-description"><?php echo $term->description; ?></div>
		<?php endif; ?>
		
		<div class="w250 right">
			
			<h3>Blog Posts</h3>
		
		<?php
			$args = array(
				'nopaging' => true,
				'posts_per_page' => '-1',
				'post_type' => 'post',
				'tax_query' => array(
					array(
						'taxonomy' => $term->taxonomy,
						'field' => 'slug',
						'terms' => $term->slug,
					),
				),
			);
			$posts = new WP_Query( $args );
		?>

	  	<?php if ( $posts->have_posts() ) : ?>

		<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>">

				<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
				
				<div class="meta"><?php docredux_timestamp(); ?></div>

			</div><!-- END - .post -->

		<?php endwhile; ?>

		<?php else : ?>

			<div class="message error">Sorry, there's no blog posts yet.</div>

		<?php endif; ?>
		
		</div><!-- END .w250.right -->
		
		<div class="w250 left">
			
			<h3>Documentation</h3>
		
		<?php
			$args = array(
				'order' => 'ASC',
				'orderby' => 'title',
				'nopaging' => true,
				'posts_per_page' => '-1',
				'post_type' => 'docredux_doc',
				'tax_query' => array(
					array(
						'taxonomy' => $term->taxonomy,
						'field' => 'slug',
						'terms' => $term->slug,
					),
				),
			);
			$documentation = new WP_Query( $args );
		?>

	  	<?php if ( $documentation->have_posts() ) : ?>

		<?php while ( $documentation->have_posts() ) : $documentation->the_post(); ?>

			<div class="post documentation" id="post-<?php the_ID(); ?>">

				<h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
				
				<div class="entry">
					<?php the_excerpt(); ?>
				</div>

			</div><!-- END - .post -->

		<?php endwhile; ?>

		<?php else : ?>

			<div class="message error">Sorry, there's no documentation yet.</div>

		<?php endif; ?>
		
		</div><!-- END .w300.left -->
	
	</div><!-- END .archive -->

</div><!-- END .content -->