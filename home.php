<?php get_header(); ?>

<div class="main">
	<div class="container">
		<div class="content left w600">
			<div class="featured">
				<p>The tech team is here to help! We have archived solutions to your most frequent problems and posted useful documentation to help you beef up your web skills.</p><p>Please, take a few minutes to explore the site. The answer to your question might just be a few clicks away.</p>
			</div>
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
			    
			</div>
			
		</div><!-- END .content -->
	
		<?php get_sidebar(); ?>
	
		<div class="clear"></div>

	</div><!-- END .container -->

</div><!-- END .main -->

<?php get_footer(); ?>
