<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div>			

                <h2>Oops... 404!</h2>
                <p>Sorry, but we can't seem to find what you're looking for. Are you searching for documentation we haven’t written yet? <a href="http://help.journalism.cuny.edu/">Let us know!</a></p>
                <p>Otherwise, try browsing or do a search to continue on your way!</p>
                <div class="search paper no-corners">
    				<?php include (TEMPLATEPATH . '/searchform.php'); ?>				
    			</div>
                <div class="fail-whale">
                    <img src="<?php bloginfo('template_directory'); ?>/images/fail-whale.png" alt="Fail Whale" />
                </div>
			
			</div><!-- END .archive -->

		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
