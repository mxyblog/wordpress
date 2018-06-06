<?php
add_action('admin_menu','theme_setting');

function theme_setting(){
	add_menu_page(__('主题设置'),__('主题设置'),'edit_themes',basename(__FILE__),'setting','dashicons-wordpress-alt');
	add_action('admin_init', 'register_theme_setting');
}

function register_theme_setting(){
	register_setting('settings_group','options');
}

function setting(){
	if ( isset($_REQUEST['settings-updated']) )
		echo '<div id="message" class="updated"><p><strong>主题设置已保存!</strong></p></div>';
	if ( 'reset' == isset($_REQUEST['reset']) ){
		delete_option('options');
		echo '<div id="message" class="updated"><p><strong>主题设置已重置!</strong></p></div>';
	}
$options=get_option('options');
function counter_user_online($temp){
$user_online = "count.txt";
touch($user_online);
$timeout = 120;
$user_arr = file_get_contents($user_online);
$user_arr = explode('#',rtrim($user_arr,'#'));
$temp = array();
foreach($user_arr as $value){
$user = explode(",",trim($value));
if (($user[0] != getenv('REMOTE_ADDR')) && ($user[1] > time())) { 
array_push($temp,$user[0].",".$user[1]);
}
}
array_push($temp,getenv('REMOTE_ADDR').",".(time() + ($timeout)).'#'); 
$user_arr = implode("#",$temp);
$fp = fopen($user_online,"w");
flock($fp,LOCK_EX); 
fputs($fp,$user_arr);
flock($fp,LOCK_UN);
fclose($fp);
echo count($temp);
}
?>
<link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.5.0/css/amazeui.min.css"/>
<style>
.admin-content {
    width: auto;
    overflow: hidden;
    height: 100%;
    background: #FFF none repeat scroll 0% 0%;
}
</style>
  <div class="admin-content">
    <div class="am-cf am-padding">
      <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">Simple主题设置</strong> / <small>Theme settings</small></div>
	    <?php
			if(isset($_REQUEST['save'])){
				echo '<strong> settings saved.</strong>';
			}
			if( 'reset' == isset($_REQUEST['reset']) ) {
				delete_option('options');
				echo '<div id="message" class="updated fade"><p><strong> settings reset.</strong></p></div>';
			}
		?>
    </div>
	<ul class="am-avg-sm-1 am-avg-md-4 am-margin am-padding am-text-center admin-content-list ">
      <li><a href="/wp-admin/edit.php?post_type=page" class="am-text-success"><span class="am-icon-btn am-icon-file-text"></span><br/>页面<br/><?php $count_pages = wp_count_posts('page'); echo $page_posts = $count_pages->publish; ?></a></li>
      <li><a href="/wp-admin/edit-comments.php" class="am-text-warning"><span class="am-icon-btn am-icon-comments"></span><br/>评论<br/><?php $total_comments = get_comment_count(); echo $total_comments['approved'];?></a></li>
      <li><a href="/wp-admin/users.php" class="am-text-danger"><span class="am-icon-btn am-icon-user"></span><br/>用户<br/><?php $result = count_users(); echo ' ', $result['total_users'], ' ';?></a></li>
      <li><a class="am-text-secondary"><span class="am-icon-btn am-icon-user-md"></span><br/>在线用户<br/><?php counter_user_online($temp); ?></a></li>
    </ul>
    <hr/>
    <div class="am-g">
      <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
		<div class="am-panel am-panel-default">
          <div class="am-panel-bd">
            <div class="user-info">
              <h3><span class="am-icon-wordpress"></span>Wordpress Theme <a>Simple</a> 2.0.0</h3>
              <p class="am-padding-left">Simple主题由<a href="http://www.loobo.me">Loobo主题笔记</a>与<a href="http://vinceok.com/">醉清风博客</a>共同开发而成</p>
              <p class="am-padding-left">请现在本页面设置完再返回博客查看效果</p>
              <p class="am-padding-left">感谢您使用Simple主题！主题将不定时更新版本优化细节，请注意查看官网<a href="vinceok.com">醉清风博客</a>。</p>
              <p class="am-padding-left">感谢使用正版，发现任何问题可以到我<a href="http://www.vinceok.me">博客</a>留言</p>
			  <h3><<<<<<<<<<赞助请扫码>>>>>>>>>></h3>
		      <img src="<?php bloginfo('template_url')?>/images/pay.png" width="300px" height="300px">
            </div>
          </div>
        </div>
		
<!-- 		 <div class="am-panel am-panel-default">
          <div class="am-panel-bd">
            <div class="user-info">
              <h3><span class="am-icon-bookmark"></span>感谢</h3>
              <p class="am-padding-left">感谢使用正版，发现任何问题可以到我<a href="http://www.vinceok.me">博客</a>留言</p>
			  <h3>Bug 反馈</h3>
              <p class="am-padding-left">感谢对Loobo主题笔记的关注和支持，如遇到 Bug 或者使用问题，可以通过以下途径反馈给我们：</p>
              <ol>
                <li>通过QQ提交 <a href="tencent://message/?uin=100041385&amp;Site=121ask.com&amp;Meu=yes"><i class="am-icon-qq"></i></a>。</li>
                <li>网站留言<a href="http://www.loobo.me/message">反馈</a>。</li>
              </ol>
         
            </div>
          </div>
        </div> -->
		
      </div>
	  
      <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
        <form class="am-form am-form-horizontal" method="post" action="options.php">
		  <?php settings_fields('settings_group'); ?>
		  <?php $options=get_option('options'); ?>
          <div class="am-form-group">
            <label for="user-name" class="am-u-sm-3 am-form-label">网站描述</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[description]" placeholder="76个字以内" value="<?php echo $options['description']; ?>">
            </div>
          </div>

          <div class="am-form-group">
            <label for="user-email" class="am-u-sm-3 am-form-label">关键词语</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[keywords]" placeholder="80个汉字,160个字符之间" value="<?php echo $options['keywords']; ?>">
            </div>
          </div>
<hr/>     
          <div class="am-form-group">
            <label for="user-phone" class="am-u-sm-3 am-form-label">网站LOGO</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[logo]" value="<?php echo $options['logo']; ?>" placeholder="这里应为图像完整的url链接">
            </div>
          </div>

          <div class="am-form-group">
            <label for="user-QQ" class="am-u-sm-3 am-form-label">网站favicon</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[favicon]" value="<?php echo $options['favicon']; ?>" placeholder="这里应为图像完整的url链接">
            </div>
          </div>
<hr/>     
          <div class="am-form-group">
            <label for="user-QQ" class="am-u-sm-3 am-form-label">顶部banner</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[banner]" value="<?php echo $options['banner']; ?>" placeholder="这里应为图像完整的url链接">
            </div>
          </div>
		  
          <div class="am-form-group">
            <label for="user-phone" class="am-u-sm-3 am-form-label">header h1</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[headerh1]" value="<?php echo $options['headerh1']; ?>" placeholder="首页顶部文字 h1">
            </div>
          </div>
		  
          <div class="am-form-group">
            <label for="user-phone" class="am-u-sm-3 am-form-label">header h3</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[headerh3]" value="<?php echo $options['headerh3']; ?>" placeholder="首页顶部文字 h3">
            </div>
          </div>
<hr/> 			  
		   <div class="am-form-group">
            <label for="user-QQ" class="am-u-sm-3 am-form-label">QQ</label>
            <div class="am-u-sm-9">
              <input type="text" placeholder="输入你的QQ号码" name="options[footer_qq]" value="<?php echo $options['footer_qq']; ?>">
            </div>
          </div>

          <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">微博</label>
            <div class="am-u-sm-9">
              <input type="text" placeholder="微博用户名" name="options[footer_weibo]" value="<?php echo $options['footer_weibo']; ?>">
			  <input type="text" name="options[footer_weibourl]" placeholder="微博主页地址" value="<?php echo $options['footer_weibourl']; ?>"  style="margin-top:10px;"/>
            </div>
          </div>

           <div class="am-form-group">
                <label for="user-weibo" class="am-u-sm-3 am-form-label">QQ群</label>
                <div class="am-u-sm-9">
                  <input type="text" placeholder="QQ群名称" name="options[footer_zhandian]" value="<?php echo $options['footer_zhandian']; ?>">
                  <input style="margin-top:10px" type="text" placeholder="QQ群号" name="options[footer_zhandiannum]" value="<?php echo $options['footer_zhandiannum']; ?>">
                  <input style="margin-top:10px" type="text" placeholder="加群链接" name="options[footer_zhandianurl]" value="<?php echo $options['footer_zhandianurl']; ?>">
                </div>
           </div>
<hr/>		  
		  <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">友情链接1</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[link1]" placeholder="名称" value="<?php echo $options['link1']; ?>" />
			  <input style="margin-top:10px" type="text" name="options[linkurl1]" placeholder="链接地址" value="<?php echo $options['linkurl1']; ?>" />
            </div>
          </div>
		  
		 <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">友情链接2</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[link2]" placeholder="名称" value="<?php echo $options['link2']; ?>" />
			  <input style="margin-top:10px" type="text" name="options[linkurl2]" placeholder="链接地址" value="<?php echo $options['linkurl2']; ?>" />
            </div>
          </div>
		  <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">友情链接3</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[link3]" placeholder="名称" value="<?php echo $options['link3']; ?>" />
			  <input style="margin-top:10px" type="text" name="options[linkurl3]" placeholder="链接地址" value="<?php echo $options['linkurl3']; ?>" />
            </div>
          </div>
		  <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">友情链接4</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[link4]" placeholder="名称" value="<?php echo $options['link4']; ?>" />
			  <input style="margin-top:10px" type="text" name="options[linkurl4]" placeholder="链接地址" value="<?php echo $options['linkurl4']; ?>" />
            </div>
          </div>
		  <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">友情链接5</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[link5]" placeholder="名称" value="<?php echo $options['link5']; ?>" />
			  <input style="margin-top:10px" type="text" name="options[linkurl5]" placeholder="链接地址" value="<?php echo $options['linkurl5']; ?>" />
            </div>
          </div>
		   <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">友情链接6</label>
            <div class="am-u-sm-9">
              <input type="text" name="options[link6]" placeholder="名称" value="<?php echo $options['link6']; ?>" />
			  <input style="margin-top:10px" type="text" name="options[linkurl6]" placeholder="链接地址" value="<?php echo $options['linkurl6']; ?>" />
            </div>
          </div>
<hr/>     
		  <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">版权信息</label>
            <div class="am-u-sm-9">
              <input type="text" placeholder="输出在首页底部版权信息" name="options[footer]" value="<?php echo $options['footer']; ?>">
            </div>
          </div>
		  
           <div class="am-form-group">
            <label for="user-weibo" class="am-u-sm-3 am-form-label">备案号</label>
            <div class="am-u-sm-9">
              <input type="text" placeholder="输出在首页底部备案号" name="options[beian]" value="<?php echo $options['beian']; ?>">
            </div>
          </div>
<hr/>
          <div class="am-form-group">
            <div class="am-u-sm-9 am-u-sm-push-3">
              <input type="submit" class="am-btn am-btn-primary" name="Submit" value="保存设置"/>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

<?php } ?>
