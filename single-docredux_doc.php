<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<?php get_template_part( 'loop', 'single_doc' ); ?>
	
		<?php get_sidebar( 'single_doc' ); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
