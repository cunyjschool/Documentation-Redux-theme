<div class="sidebar right w300">
	<?php if ( !is_home() ) { ?>
		<div class="widget">
			<h4>Search </h4>
			<div class="no-bottom-corners paper"><input type="text" value="Documentation, news, events..."></div>
		</div>
	<?php } ?>
	<div class="widget">
		<h4>Can't find what you're looking for?</h4>
		<ul class="paper no-bottom-corners">
			<li><a href="<?php bloginfo('url') ?>/documentation/">Browse all documentation</a></li>
			<li><a href="http://help.journalism.cuny.edu/">Submit a support ticket</a></li>
		</ul>
	</div>
	<div class="widget">
		<h4>Web team on duty</h4>
		<div class="paper no-bottom-corners">
			<?php echo get_avatar( get_the_author_meta(), '50' ); ?>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci.</p>
			<?php echo get_avatar( get_the_author_meta(), '50' ); ?>
			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci.</p>
			<p><a href="<?php bloginfo('url') ?>/staff/">See all IT Staff &rarr;</a></p>
		</div>			
	</div>	
</div><!-- END .sidebar -->