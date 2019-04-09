<?php $options=get_option('options'); ?>
<!--footer-->
<footer>
	<div class="main-footer">
	    <div class="container">
	        <div class="row footrow">
	        	<div class="col-md-3">
	                <div class="widget catebox">
	                    <h4 class="title">分类目录</h4>
	                    <div class="box category clearfix">
							<?php require('wp-blog-header.php');
                            $args=array('title_li'=>'');
                            wp_list_categories($args);
                        	?>									
						</div>
	                </div>
	            </div>
				<div class="col-md-4">
		            <div class="widget tagbox">
		                <h4 class="title">文章标签</h4>
		                <div class="box tags clearfix">
							<?php $html = '<ul class="post_tags">';
		                        foreach (get_tags( array('number' => 12, 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => false) ) as $tag){
		                        	$tag_link = get_tag_link($tag->term_id);
		                        	$html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
		                        	$html .= "{$tag->name} ({$tag->count})</a></li>";
		                        }
		                        $html .= '</ul>';
		                    	echo $html;
							?>
						</div>
		    		</div>
				</div>
				<div class="col-md-3">
					<div class="widget linkbox">
						<h4 class="title">友情链接</h4>
						<div class="box friend-links clearfix">
						  <?php if ($options['linkurl1']):?>
							<li><a href="<?php echo $options['linkurl1']; ?>" target="_blank"><?php echo $options['link1']; ?></a></li>
						  <?php else :?>
						    <li><a href="http://www.loobo.me">主题笔记</a></li>
						  <?php endif;?>
						  <?php if ($options['linkurl2']):?>
							<li><a href="<?php echo $options['linkurl2']; ?>" target="_blank"><?php echo $options['link2']; ?></a></li>
						  <?php else :?>
						    <li><a href="http://www.vinceok.com/">醉清风</a></li>
						  <?php endif;?>
						  <?php if ($options['linkurl3']):?>
							<li><a href="<?php echo $options['linkurl3']; ?>" target="_blank"><?php echo $options['link3']; ?></a></li>
						  <?php else :?><?php endif;?>
						  <?php if ($options['linkurl4']):?>
							<li><a href="<?php echo $options['linkurl4']; ?>" target="_blank"><?php echo $options['link4']; ?></a></li>
						  <?php else :?><?php endif;?>
						  <?php if ($options['linkurl5']):?>
							<li><a href="<?php echo $options['linkurl5']; ?>" target="_blank"><?php echo $options['link5']; ?></a></li>
					      <?php else :?><?php endif;?>
						  <?php if ($options['linkurl6']):?>
							<li><a href="<?php echo $options['linkurl6']; ?>" target="_blank"><?php echo $options['link6']; ?></a></li>
						  <?php else :?><?php endif;?>
						</div>
					</div>
				</div>
				<div class="col-md-2">
		            <div class="widget contactbox">
		                <h4 class="title">联系我们</h4>
		                <div class="contact-us clearfix">
							<li><a href="tencent://message/?uin=<?php echo $options['footer_qq']; ?>&amp;Site=121ask.com&amp;Meu=yes">
							<i class="fa fa-qq"></i><?php echo $options['footer_qq']; ?></a></li>
							<li><a href="<?php echo $options['footer_weibourl']; ?>"><i class="fa fa-weibo"></i><?php echo $options['footer_weibo']; ?></a></li>
							<li>
							<?php if ($options['zhandian']):?>
							    <a href="<?php echo $options['footer_zhandianurl']; ?>"><i class="fa fa-external-link"></i><?php echo $options['footer_zhandian']; ?></a>
							<?php else :?>
							    <a href="<?php echo $options['footer_zhandianurl']; ?>" title="<?php echo $options['footer_zhandian']; ?>"><i class="fa fa-users"></i><?php echo $options['footer_zhandiannum']; ?></a>
							<?php endif;?>
							</li>
						</div>
			        </div>
			    </div>
	        </div>
	        <div class="row">
	        	<div class="copyright">
	        		<span>Copyright &copy; <a href="<?php bloginfo('url');?>"><?php echo $options['footer']; ?></a>&nbsp;&nbsp;</span>
	        		<span><?php echo $options['beian']; ?></span>
	        		<!-- <span class="hidden-xs">Theme by <a href="http://www.loobo.me">主题笔记</a> & <a href="http://vinceok.com">醉清风博客</a></span> -->
	        		<span class="hidden-xs">加载用时：</span><span><?php timer_stop(1); ?>s</span>
	        		<a href="tencent://message/?uin=1453767261&Site=121ask.com&Meu=yes" class="kefu pull-right hidden-xs"><i class="fa fa-qq"></i>在线联系我</a>
	        	</div>
	        </div>
	    </div>
	</div>
</footer>	


<!-- 菜单&侧边栏按钮 -->
<div class="icon-search">
	<i class="fa fa-search"></i>
</div>
<div class="menu mobile-menuicon">
	<i class="fa fa-bars"></i>
</div>
<a class="to-top">
	<span class="topicon"><i class="fa fa-angle-up"></i></span>
	<span class="toptext">Top</span>
</a>
<div class="menubox">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php wp_nav_menu( array( 'theme_location' => 'simple','menu_class'=>'icon-list','container'=>'ul','fallback_cb' => 'link_to_menu_editor')); ?>
			</div>
		</div>
	</div>
	<a href="javascript:;" class="menu-close">&times;</a>
</div>
<script src="//cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
<script src="<?php bloginfo('template_url')?>/js/jquery.toTop.min.js"></script>
<script src="<?php bloginfo('template_url')?>/js/menu.js"></script>
<script>
$('.to-top').toTop({
	position:false,
	offset:1000,
});
$('.icon-search').click(function(){
	$('.search-form').css('top','50%');
	$('.search-form').css('marginTop','-80px');
	$('.search-form').css('opacity','1');
});
$('.search-close').click(function(){
	$('.search-form').css('top','0');
	$('.search-form').css('opacity','0');
});
</script>
<?php wp_footer(); ?>
</body>
</html>
