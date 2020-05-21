<div id="login">
	<?php get_currentuserinfo();global $current_user, $user_ID, $user_identity;	if( !$user_ID || '' == $user_ID ) { ?>
		<div class="login-t">用户登录</div>
		<span class="close"><i class="iconfont icon-windowclose"></i></span>
		<form action="<?php echo wp_login_url( get_permalink() ); ?>" method="post" id="loginform">
        <p>
            <label class="icon" for="username"><i class="iconfont icon-account"></i></label>
            <input class="input-control" id="log" type="text" placeholder="请输入用户名" name="log" required="" aria-required="true">
        </p>
		
        <p>
            <label class="icon" for="password"><i class="iconfont icon-lock"></i></label>
            <input class="input-control" id="pwd" type="password" placeholder="请输入密码" name="pwd" required="" aria-required="true">
        </p>
		
        <p class="safe">
		<?php if(get_option('users_can_register')==1) $register = 'on'; else $register = 'off'; ?>
            <label class="remembermetext" for="rememberme"><input name="rememberme" type="checkbox" checked="checked" id="rememberme" class="rememberme" value="forever">记住我的登录</label>
			<span class="lost">
			<?php if($register == 'on') { ?><a href="<?php echo get_option('home'); ?>/wp-login.php?action=register">注册</a> | <?php }?> 
			<?php if($register == 'off') { ?>禁止注册！| <?php }?> 
            <a  href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword">忘记密码?</a>
			</span>
		
        </p>
		
        <p>
            <input class="submit" type="submit" value="登录" name="submit">
			<input type="hidden" name="redirect_to" value="<?php echo $_SERVER[ 'REQUEST_URI' ]; ?>" />
        </p>
		
		</form>
	<?php } ?>
	<?php global $user_identity,$user_level;get_currentuserinfo();if ($user_identity) { ?>
		<div class="login-t">网站管理</div>
		<span class="close"><i class="iconfont icon-windowclose"></i></span>
		<div class="login-user">
			<?php global $current_user;	get_currentuserinfo();
				echo get_avatar( $current_user->user_email, 64);
			?>
			<div class="login-text">
			登录者：<?php echo $user_identity; ?><br/>
			<?php if (current_user_can('level_10') ){ ?><?php wp_register('', ''); ?><br/><?php } ?>
			<a href="<?php echo wp_logout_url( home_url() ); ?>" title="退出"> 退出</a>
			</div>
		<div class="clear"></div>
		</div>
	 <?php } ?>
	 <div class="login-b"></div>
</div>