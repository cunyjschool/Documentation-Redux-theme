<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
	<label class="hidden" for="s"><?php _e(''); ?></label>
      <div id="search">
		<input class="search-box" type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
        <button class="search-button" type="submit">Search</button>
       </div>
</form>