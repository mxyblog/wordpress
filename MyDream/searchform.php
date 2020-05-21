<div id="searchbar">
	<form method="get" id="searchform" action="<?php echo esc_url( home_url() ); ?>/">
		<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" placeholder="输入搜索内容" required />
		<button type="submit" id="searchsubmit">搜索</button>
	</form>
</div>