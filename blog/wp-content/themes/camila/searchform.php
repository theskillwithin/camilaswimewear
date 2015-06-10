<form method="get" action="<?php  echo home_url(); ?>/" id="search_mini_form">
	<div class="input-box">
		<label for="search">Search:</label>
		<input type="search" placeholder="Search entire blog here..." maxlength="128" class="input-text required-entry" value="<?php the_search_query(); ?>" name="s" id="s" autocomplete="off">
		<button class="button search-button" title="Search" type="submit"><span><span>Search</span></span></button>
	</div>
</form>
