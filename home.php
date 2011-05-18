<?php get_header(); ?>

<div class="main">
	
	<div class="container">
		
		<div class="content left w600">
			
			<div class="featured">
				<?php docredux_home_description(); ?>
			</div><!-- END .featured -->
			
			<div class="search paper no-corners">
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>				
			</div>
			
            <div class="paper featured-topics-items">
                
                <div class="home-left-column widget-column left">
                <?php dynamic_sidebar('home-left-column'); ?>
                </div>
                
                <div class="home-right-column widget-column right">
                <?php dynamic_sidebar('home-right-column'); ?>
                </div>
                
                <div class="clear"></div>
                
            </div><!-- END .featured-topics-items -->
			
		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer('home'); ?>
