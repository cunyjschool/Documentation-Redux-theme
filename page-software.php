<?php
/*
Template Name: Page - Software
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive pads">
			
					<h2>Software</h2>
					
					<table class="paper full-width pads tax-index">
				        <tr class="bold">
				            <td>Program</td>
				            <td>Documentation</td>
				            <td>Posts</td>
				        </tr>
						<?php $all_software = get_terms('docredux_software');
						foreach($all_software as $software) {
						  $software_docs = new WP_Query(array(
                            'post_type' => 'docredux_doc',
						    'post_per_page'=>-1,
						    'taxonomy'=>'docredux_software',
						    'term' => $software->slug,
						  ));
						  $software_posts = new WP_Query(array(
                            'post_type' => 'post',
  						    'post_per_page'=>-1,
  						    'taxonomy'=>'docredux_software',
  						    'term' => $software->slug,
  						  ));
						  $link = get_term_link(intval($software->term_id),'docredux_software');
						  echo "<tr>";
                          echo "<td><h4><a href=\"{$link}\">{$software->name}</a></h4></td>";
						  echo '<td><ul>';
						  while ( $software_docs->have_posts() ) {
						    $software_docs->the_post();
						    $link = get_permalink($post->ID);
						    $title = get_the_title();
						    echo "<li><a href=\"{$link}\">{$title}</a></li>";
						  }
						  echo '</ul></td>';
						  echo '<td><ul>';
						  while ( $software_posts->have_posts() ) {
						    $software_posts->the_post();
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
