<?php get_header(); ?>

<div class="main">
	
	<div class="container">
	
		<?php get_template_part( 'loop', 'tax' ); ?>
	
		<?php get_sidebar('tax'); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
