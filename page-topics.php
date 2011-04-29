<?php
/*
Template Name: Page - Topics
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive pads">
			
					<h2>Topics</h2>
					
					<table class="paper full-width pads tax-index">
				        <tr class="bold">
				            <td>Topic</td>
				            <td>Documentation</td>
				            <td>Posts</td>
				        </tr>
						<?php $all_topics = get_terms('docredux_topics');
						foreach($all_topics as $topics) {
						  $topics_docs = new WP_Query(array(
                            'post_type' => 'docredux_doc',
						    'post_per_page'=>-1,
						    'taxonomy'=>'docredux_topics',
						    'term' => $topics->slug,
						  ));
						  $topics_posts = new WP_Query(array(
                            'post_type' => 'post',
  						    'post_per_page'=>-1,
  						    'taxonomy'=>'docredux_topics',
  						    'term' => $topics->slug,
  						  ));
						  $link = get_term_link(intval($topics->term_id),'docredux_topics');
						  echo "<tr>";
                          echo "<td><h4><a href=\"{$link}\">{$topics->name}</a></h4></td>";
						  echo '<td><ul>';
						  while ( $topics_docs->have_posts() ) {
						    $topics_docs->the_post();
						    $link = get_permalink($post->ID);
						    $title = get_the_title();
						    echo "<li><a href=\"{$link}\">{$title}</a></li>";
						  }
						  echo '</ul></td>';
						  echo '<td><ul>';
						  while ( $topics_posts->have_posts() ) {
						    $topics_posts->the_post();
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
