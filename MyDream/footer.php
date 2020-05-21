</div>
<!-- 友情链接 -->
<?php get_template_part( 'inc/footer-links' ); ?>

<!-- 版权说明 -->
<footer id="footer">
	<div class="bottom-nav">
				<?php
				wp_nav_menu( array(
					'theme_location'	=> 'header',
					'menu_class'		=> 'bottom-menu',
					'fallback_cb'		=> 'default_menu'
				) );
			?>
	</div>		
	<div id="contentinfo">
		Copyright © 2007-<?php date_default_timezone_set('PRC'); echo date('Y') ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> All rights reserved. | Theme by <a  href="https://www.ricemouse.com/27.html" title="米鼠" target="_blank">Mydream</a> | <?php echo get_option( 'zh_cn_l10n_icp_num' );?>
	</div>
</footer>

<!-- 返回顶部 -->
<ul id="scroll">
	<li><a class="hidden-widget" href="javascript:hiddenwidget()" title="隐藏侧边栏"><i class="iconfont icon-windowclose"></i></a></li>
	<li><a class="scroll-top" title="返回顶部"><i class="iconfont icon-chevronup"></i></a></li>
	<li><a class="scroll-bottom" title="转到底部"><i class="iconfont icon-chevrondown"></i></a></li>
</ul>

<!-- 隐藏侧边栏 -->
<script>
// 隐藏侧边
function hiddenwidget() {
var R=document.getElementById("sidebar");
var L=document.getElementById("primary");
if (R.className=="sidebar")
	{
		R.className="widget-area";
		L.className="content-area";
	}
else
	{
		R.className="sidebar";
		L.className="primary";
	}
}
</script>


<!-- 百度分享 -->
<?php if ( is_single() ) { ?>
	<?php if (md_get_option('baidu_share')) : ?>
		<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"18"},"share":{"bdSize":18}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
	<?php else: ?>
		<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"18"},"share":{"bdSize":18}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
	<?php endif; ?>	
<?php } ?>

<!-- 左下播放器 -->
<?php if (md_get_option('playerbox')) { ?>
	<?php get_template_part( 'inc/playerbox' ); ?>
<?php } ?>

<?php wp_footer(); ?>
</body>
</html>

