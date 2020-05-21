<div class="clear"></div>
<div id="social">
	<div class="social-main">
		<span class="post-like">
				<a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="md_like <?php if(isset($_COOKIE['md_like_'.$post->ID])) echo 'done';?>"><i class="iconfont icon-thumbupoutline"></i>喜欢 <i class="count">
				<?php if( get_post_meta($post->ID,'md_like',true) ){
            		echo get_post_meta($post->ID,'md_like',true);
                } else {
					echo '0';
				}?></i>
				</a>
		</span>
		
		<span class="share-sd">
				<span class="share-s"><a href="javascript:void(0)" id="share-s" title="分享"><i class="iconfont icon-sharevariant"></i>分享</a></span>
				<div id="share">
					<ul class="bdsharebuttonbox">
						<li><a title="分享到QQ空间" class="iconfont icon-kongjian" data-cmd="qzone"></a></li>
						<li><a title="分享到QQ好友" class="iconfont icon-qq0" data-cmd="sqq"></a></li>
						<li><a title="分享到新浪微博" class="iconfont icon-sina" data-cmd="tsina"></a></li>
						<li><a title="分享到人人网" class="iconfont icon-renren0" data-cmd="renren"></a></li>		
						<li><a title="分享到微信" class="iconfont icon-weixin0" data-cmd="weixin"></a></li>						
					</ul>
				</div>
		</span>
		<div class="clear"></div>
	</div>
</div>
