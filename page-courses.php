<?php
/*
Template Name: Page - Courses
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive pads">
			
					<h2>Courses</h2>
					
					<table class="paper full-width tax-index">
				        <tr class="bold">
				            <td>Course</td>
				            <td>Documentation</td>
				            <td>Posts</td>
				        </tr>
						<?php $all_courses = get_terms('docredux_courses');
						foreach($all_courses as $courses) {
						  $courses_docs = new WP_Query(array(
                            'post_type' => 'docredux_doc',
						    'post_per_page'=>-1,
						    'taxonomy'=>'docredux_courses',
						    'term' => $courses->slug,
						  ));
						  $courses_posts = new WP_Query(array(
                            'post_type' => 'post',
  						    'post_per_page'=>-1,
  						    'taxonomy'=>'docredux_courses',
  						    'term' => $courses->slug,
  						  ));
						  $link = get_term_link(intval($courses->term_id),'docredux_courses');
						  echo "<tr>";
                          echo "<td><h4><a href=\"{$link}\">{$courses->name}</a></h4></td>";
						  echo '<td><ul>';
						  while ( $courses_docs->have_posts() ) {
						    $courses_docs->the_post();
						    $link = get_permalink($post->ID);
						    $title = get_the_title();
						    echo "<li><a href=\"{$link}\">{$title}</a></li>";
						  }
						  echo '</ul></td>';
						  echo '<td><ul>';
						  while ( $courses_posts->have_posts() ) {
						    $courses_posts->the_post();
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
