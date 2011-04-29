<?php
/*
Template Name: Page - Themes
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive pads">
			
					<h2>WordPress Themes</h2>
					
					<table class="paper full-width pads tax-index">
				        <tr class="bold">
				            <td>Theme</td>
				            <td>Documentation</td>
				            <td>Posts</td>
				        </tr>
						<?php $all_wpthemes = get_terms('docredux_wpthemes');
						foreach($all_wpthemes as $wpthemes) {
						  $wpthemes_docs = new WP_Query(array(
                            'post_type' => 'docredux_doc',
						    'post_per_page'=>-1,
						    'taxonomy'=>'docredux_wpthemes',
						    'term' => $wpthemes->slug,
						  ));
						  $wpthemes_posts = new WP_Query(array(
                            'post_type' => 'post',
  						    'post_per_page'=>-1,
  						    'taxonomy'=>'docredux_wpthemes',
  						    'term' => $wpthemes->slug,
  						  ));
						  $link = get_term_link(intval($wpthemes->term_id),'docredux_wpthemes');
						  echo "<tr>";
                          echo "<td><h4><a href=\"{$link}\">{$wpthemes->name}</a></h4></td>";
						  echo '<td><ul>';
						  while ( $wpthemes_docs->have_posts() ) {
						    $wpthemes_docs->the_post();
						    $link = get_permalink($post->ID);
						    $title = get_the_title();
						    echo "<li><a href=\"{$link}\">{$title}</a></li>";
						  }
						  echo '</ul></td>';
						  echo '<td><ul>';
						  while ( $wpthemes_posts->have_posts() ) {
						    $wpthemes_posts->the_post();
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
