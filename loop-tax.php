<div class="content left w600">
	
	<div class="archive">
		
		<?php
			$term = get_queried_object();
			$taxonomy = get_taxonomy( $term->taxonomy );
		?>
		
		<h2 class="term-name"><a href="<?php bloginfo('url'); ?>/<?php echo docredux_get_term_base( $term ) . '/'; ?>"><?php echo $taxonomy->labels->name; ?></a>: <?php echo $term->name; ?></h2>
		
		<?php if ( !empty( $term->description ) ): ?>
			<div class="term-description"><?php echo wpautop( $term->description ); ?></div>
		<?php endif; ?>
				
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
				
				<div class="meta">Updated <?php docredux_timestamp( false, 'modified' ); ?></div>

			</div><!-- END - .post -->

		<?php endwhile; ?>

		<?php else : ?>

			<div class="message error">Sorry, there's no documentation yet.</div>

		<?php endif; ?>
			
	</div><!-- END .archive -->

</div><!-- END .content -->