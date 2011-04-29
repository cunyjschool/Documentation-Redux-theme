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
					
					<table class="paper full-width tax-index">
				        <tr class="bold">
				            <td>Equipment</td>
				            <td>Documentation</td>
				            <td>Posts</td>
				        </tr>
						<?php $all_hardware = get_terms('docredux_hardware');
						foreach($all_hardware as $hardware) {
						  $hardware_docs = new WP_Query(array(
                            'post_type' => 'docredux_doc',
						    'post_per_page'=>-1,
						    'taxonomy'=>'docredux_hardware',
						    'term' => $hardware->slug,
						  ));
						  $hardware_posts = new WP_Query(array(
                            'post_type' => 'post',
  						    'post_per_page'=>-1,
  						    'taxonomy'=>'docredux_hardware',
  						    'term' => $hardware->slug,
  						  ));
						  $link = get_term_link(intval($hardware->term_id),'docredux_hardware');
						  echo "<tr>";
                          echo "<td><h4><a href=\"{$link}\">{$hardware->name}</a></h4></td>";
						  echo '<td><ul>';
						  while ( $hardware_docs->have_posts() ) {
						    $hardware_docs->the_post();
						    $link = get_permalink($post->ID);
						    $title = get_the_title();
						    echo "<li><a href=\"{$link}\">{$title}</a></li>";
						  }
						  echo '</ul></td>';
						  echo '<td><ul>';
						  while ( $hardware_posts->have_posts() ) {
						    $hardware_posts->the_post();
						    $link = get_permalink($post->ID);
						    $title = get_the_title();
						    echo "<li><a href=\"{$link}\">{$title}</a></li>";
						  }
						  echo '</ul></td>';
						  echo '</tr>';
						} ?>
					</table>
			
			</div><!-- END .archive -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
