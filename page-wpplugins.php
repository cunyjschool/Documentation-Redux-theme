<?php
/*
Template Name: Page - Plugins
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive">
			
					<h2>WordPress Plugins</h2>
					
					<table class="paper full-width tax-index">
				        <tr class="bold">
				            <td>Plugin</td>
				            <td>Documentation</td>
				            <td>Posts</td>
				        </tr>
						<?php $all_wpplugins = get_terms('docredux_wpplugins');
						foreach($all_wpplugins as $wpplugins) {
						  $wpplugins_docs = new WP_Query(array(
                            'post_type' => 'docredux_doc',
						    'post_per_page'=>-1,
						    'taxonomy'=>'docredux_wpplugins',
						    'term' => $wpplugins->slug,
						  ));
						  $wpplugins_posts = new WP_Query(array(
                            'post_type' => 'post',
  						    'post_per_page'=>-1,
  						    'taxonomy'=>'docredux_wpplugins',
  						    'term' => $wpplugins->slug,
  						  ));
						  $link = get_term_link(intval($wpplugins->term_id),'docredux_wpplugins');
						  echo "<tr>";
                          echo "<td><h4><a href=\"{$link}\">{$wpplugins->name}</a></h4></td>";
						  echo '<td><ul>';
						  while ( $wpplugins_docs->have_posts() ) {
						    $wpplugins_docs->the_post();
						    $link = get_permalink($post->ID);
						    $title = get_the_title();
						    echo "<li><a href=\"{$link}\">{$title}</a></li>";
						  }
						  echo '</ul></td>';
						  echo '<td><ul>';
						  while ( $wpplugins_posts->have_posts() ) {
						    $wpplugins_posts->the_post();
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
