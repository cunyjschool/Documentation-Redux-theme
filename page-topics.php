<?php
/*
Template Name: Page - Topics
*/
?>

<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="archive">
			
				<h2>Topics</h2>
				
				<?php
					$page_anchors = array();
					$all_topics = get_terms( 'docredux_topics' );
					foreach ( $all_topics as $topics ) {
						$first_letter = substr( strtolower( $topics->name ), 0, 1 );
						$page_anchors[$first_letter] = true;
					} // END foreach ( $all_topics as $topics )
				
					$page_anchors_html = '';
					foreach ( $page_anchors as $letter => $value ) {
						$page_anchors_html .= '<a href="#' . $letter . '">' . strtoupper( $letter ) . '</a> | ';
					}
					$page_anchors_html = rtrim( $page_anchors_html, '| ' );
				?>
				
				<?php if ( count( $page_anchors ) > 1 ): ?>
					<div class="jump">Jump to <?php echo $page_anchors_html; ?></div>
				<?php endif; ?>
				
				<table class="paper full-width tax-index">
			        <tr class="bold">
			            <td>Topic</td>
			            <td>Documentation</td>
			            <td>Posts</td>
			        </tr>
					<?php
					
					foreach( $all_topics as $topics ) {
						
						$args = array(
							'post_type' => 'docredux_doc',
					    	'post_per_page'=>-1,
					    	'taxonomy'=>'docredux_topics',
					    	'term' => $topics->slug,
					  	);
						$topics_docs = new WP_Query( $args );
					
					  $topics_posts = new WP_Query(array(
                           'post_type' => 'post',
 						    'post_per_page'=>-1,
 						    'taxonomy'=>'docredux_topics',
 						    'term' => $topics->slug,
 						  ));
					  $link = get_term_link(intval($topics->term_id),'docredux_topics');
					  	
						echo "<tr>";
						echo "<td><h4>";
						// Add a page anchor for the first in the series
						$first_letter = substr( strtolower( $topics->name ), 0, 1 );
						if ( $page_anchors[$first_letter] ) {
							echo '<a name="' . $first_letter . '"></a>';
							$page_anchors[$first_letter] = false;
						}
						echo "<a href=\"{$link}\">{$topics->name}</a></h4></td>";
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
					} // END foreach( $all_topics as $topics )
					?>
				</table>
			
			</div><!-- END .archive -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
