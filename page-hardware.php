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
					
					<?php $main_ingredients = get_terms('docredux_hardware');
					foreach($main_ingredients as $main_ingredient) {
					  $individual_hardware = new WP_Query(array(
					    'post_type' => 'docredux_doc',
					    'post_per_page'=>-1,
					    'taxonomy'=>'docredux_hardware',
					    'term' => $main_ingredient->slug,
					  ));
					  $link = get_term_link(intval($main_ingredient->term_id),'docredux_hardware');
					  echo "<div class=\"doc-index\" ><h4><a href=\"{$link}\">{$main_ingredient->name}</a></h4>";
					  echo '<ul>';
					  while ( $individual_hardware->have_posts() ) {
					    $individual_hardware->the_post();
					    $link = get_permalink($post->ID);
					    $title = get_the_title();
					    echo "<li><a href=\"{$link}\">{$title}</a></li>";
					  }
					  echo '</ul></div>';
					} ?>
			
			</div><!-- END .archive -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
