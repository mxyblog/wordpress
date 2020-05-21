	<div id="user-profile">
		<?php if ( current_user_can('level_10') ){ ?>
			<span class="nav-set">
			 	<span class="nav-login">
			 	<?php if ( is_user_logged_in()){ ?>
					<a href="#login" class="flatbtn" id="login-main" ><i class="iconfont icon-settings"></i>管理</a>
				<?php } else { ?>
				<a href="#login" class="flatbtn" id="login-main" ><i class="iconfont icon-login"></i>登录</a>
				<?php } ?>
				</span>
			</span>
		<?php } else { ?>
				<span class="nav-set">
				 	<span class="nav-login">
				 	<?php if ( is_user_logged_in()){ ?>
				 	<a href="<?php echo wp_logout_url( home_url() ); ?>" class="flatbtn" title="退出"><i class="iconfont icon-logout"></i>退出</a>
					<?php } else { ?>
					<a href="#login" class="flatbtn" id="login-main" ><i class="iconfont icon-login"></i>登录</a>
					<?php } ?>
					</span>
				</span>
		<?php } ?>
	</div>
