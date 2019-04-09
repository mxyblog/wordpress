<?php
/**
 * The template for Settings content control
 *
 * @package Vtrois
 * @version 1.1
 */

function optionsframework_option_name() {

	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );

}

function optionsframework_options() {

	$imagepath =  get_template_directory_uri() . '/images/options/';

	$options = array();
	$options[] = array(
		'name' => '站点配置',
		'type' => 'heading');
	$options[] = array(
		'name' => '站点logo',
		'desc' => '不添加则显示站点标题，图片最大高度：50px',
		'id' => 'site_logo',
		'type' => 'upload');
	$options[] = array(
		'name' => '背景颜色',
		'desc' => '选择背景颜色',
		'id' => 'background_color',
		'std' => '#f9f9f9',
		'type' => 'color' );
	$options[] = array(
		'name' => '背景图片',
		'desc' => '选择背景图片，当上传背景图片时，将自动覆盖背景颜色',
		'id' => 'background_image',
		'type' => 'upload');
	$options[] = array(
		'name' => '站点黑白',
		'desc' => '是否启用站点黑白功能(一般常用于悼念日)',
		'id' => 'site_bw',
		'std' => '0',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '分类页面',
		'desc' =>'是否启用分类页面的名称以及简介功能',
		'id' => 'show_head_cat',
		'std' => '1',
		'type' => 'checkbox');
	$options[] = array(
		'name' => '标签页面',
		'desc' =>'是否启用标签页面的名称以及简介功能',
		'id' => 'show_head_tag',
		'std' => '1',
		'type' => 'checkbox');
	$options[] = array(
		'name' => '文章缩略图',
		'desc' => '是否启用文章列表页缩略图功能',
		'id' => 'show_thumb',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '网易云音乐',
		'desc' => '是否启用网易云音乐自动播放功能',
		'id' => 'wy_music',
		'std' => '0',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '打赏连接',
		'desc' => '输入您的打赏介绍页面的连接，若没开启点赞打赏功能该项无效',
		'id' => 'donate_links',
		'type' => 'text'
	);
	$options[] = array(
		'name' => '工信部备案信息',
		'desc' => '输入您的工信部备案号，针对国际版没有备案信息栏目的功能',
		'id' => 'icp_num',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => '公安网备案信息',
		'desc' => '输入您的公安网备案号',
		'id' => 'gov_num',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => '公安网备案连接',
		'desc' => '输入您的公安网备案的链接地址',
		'id' => 'gov_link',
		'type' => 'text'
	);	
	$options[] = array(
		'name' => 'SEO设置',
		'type' => 'heading');
	$options[] = array(
		'name' => '关键词',
		'desc' => '每个关键词之间用英文逗号分割',
		'id' => 'site_keywords',
		'type' => 'text');
	$options[] = array(
		'name' => '站点描述',
		'id' => 'site_description',
		'type' => 'textarea');
	$options[] = array(
		'name' => '站点统计',
		'desc' => '填写时需要去掉&lt;script&gt;与&lt;/script&gt;标签',
		'id' => 'site_tongji',
		'type' => 'textarea');
	$options[] = array(
		'name' => '内容页面',
		'type' => 'heading');
	$options[] = array(
		'name' => '文章布局',
		'desc' => '选择你喜欢的整体布局,显示左边栏，右边栏或者不显示任何边栏。默认:显示右边栏',
		'id' => "side_bar",
		'std' => "right_side",
		'type' => "images",
		'options' => array(
			'left_side' => $imagepath . 'col-left.png',
			'right_side' => $imagepath . 'col-right.png')
	);
	$options[] = array(
		'name' => '顶部颜色',
		'desc' => '选择顶部颜色',
		'id' => 'banner_single_color',
		'std' => '#333333',
		'type' => 'color' );
	$options[] = array(
		'name' => '顶部图片',
		'desc' => '选择顶部图片，当上传顶部图片时，将自动覆盖顶部颜色',
		'id' => 'banner_image',
		'std' => get_template_directory_uri() . '/images/dark-wall.png',
		'type' => 'upload');
	$options[] = array(
		'name' => '版权声明',
		'desc' => '是否启用 CC BY-SA 4.0 声明',
		'id' => 'post_cc',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '分享按钮',
		'desc' => '是否启用文章分享功能',
		'id' => 'post_share',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '打赏按钮',
		'desc' => '是否启用文章打赏功能',
		'id' => 'post_like_donate',
		'std' => '0',
		'type' => 'checkbox',
	);
	$options[] = array(
		'name' => '模板页面',
		'type' => 'heading');
	$options[] = array(
		'name' => '页面布局',
		'desc' => '选择你喜欢的整体布局,显示左边栏，右边栏或者不显示任何边栏。默认:显示右边栏',
		'id' => "page_side_bar",
		'std' => "right_side",
		'type' => "images",
		'options' => array(
			'left_side' => $imagepath . 'col-left.png',
			'right_side' => $imagepath . 'col-right.png')
	);	
	$options[] = array(
		'name' => '顶部颜色',
		'desc' => '选择顶部颜色',
		'id' => 'page_banner_single_color',
		'std' => '#333333',
		'type' => 'color' );
	$options[] = array(
		'name' => '顶部图片',
		'desc' => '选择顶部图片，当上传顶部图片时，将自动覆盖顶部颜色',
		'id' => 'page_banner_image',
		'std' => get_template_directory_uri() . '/images/dark-wall.png',
		'type' => 'upload');
	$options[] = array(
		'name' => '版权声明',
		'desc' => '是否启用 CC BY-SA 4.0 声明',
		'id' => 'page_cc',
		'std' => '0',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '分享按钮',
		'desc' => '是否启用文章分享功能',
		'id' => 'page_share',
		'std' => '0',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '打赏按钮',
		'desc' => '是否启用文章打赏功能',
		'id' => 'page_like_donate',
		'std' => '0',
		'type' => 'checkbox',
	);
	$options[] = array(
		'name' => '社交组件',
		'type' => 'heading');
	$options[] = array(
		'name' => '新浪微博',
		'desc' => '连接前要带有 http:// 或者 https:// ',
		'id' => 'social_weibo',
		'type' => 'text');
	$options[] = array(
		'name' => '腾讯微博',
		'desc' => '连接前要带有 http:// 或者 https:// ',
		'id' => 'social_tweibo',
		'type' => 'text');
	$options[] = array(
		'name' => 'Twitter',
		'desc' => '连接前要带有 http:// 或者 https:// ',
		'id' => 'social_twitter',
		'type' => 'text');
	$options[] = array(
		'name' => 'FaceBook',
		'desc' => '连接前要带有 http:// 或者 https:// ',
		'id' => 'social_facebook',
		'type' => 'text');
	$options[] = array(
		'name' => 'LinkedIn',
		'desc' => '连接前要带有 http:// 或者 https:// ',
		'id' => 'social_linkedin',
		'type' => 'text');
	$options[] = array(
		'name' => 'GitHub',
		'desc' => '连接前要带有 http:// 或者 https:// ',
		'id' => 'social_github',
		'type' => 'text');
	$options[] = array(
		'name' => '404页面',
		'type' => 'heading');
	$options[] = array(
		'name' => '页面图片',
		'id' => 'error_image',
		'std' => get_template_directory_uri() . '/images/404.png',
		'class' => 'error_image',
		'type' => 'upload');
	$options[] = array(
		'name' => '页面内容',
		'id' => 'error_text',
		'std' => '您输入的网址有误或连接已经过期',
		'type' => 'text');
	$options[] = array(
		'name' => '轮播配置',
		'type' => 'heading');
	$options[] = array(
		'name' => '轮播开关',
		'desc' => '是否启用首页轮播功能',
		'id' => 'snape_banner',
		'std' => '0',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '轮播图片①',
		'id' => 'snape_banner1',
		'type' => 'upload');
	$options[] = array(
		'name' => '连接地址',
		'id' => 'snape_banner_url1',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '轮播图片②',
		'id' => 'snape_banner2',
		'type' => 'upload');
	$options[] = array(
		'name' => '连接地址',
		'id' => 'snape_banner_url2',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '轮播图片③',
		'id' => 'snape_banner3',
		'type' => 'upload');
	$options[] = array(
		'name' => '连接地址',
		'id' => 'snape_banner_url3',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '轮播图片④',
		'id' => 'snape_banner4',
		'type' => 'upload');
	$options[] = array(
		'name' => '连接地址',
		'id' => 'snape_banner_url4',
		'std' => '',
		'type' => 'text');
	$options[] = array(
		'name' => '轮播图片⑤',
		'id' => 'snape_banner5',
		'type' => 'upload');
	$options[] = array(
		'name' => '连接地址',
		'id' => 'snape_banner_url5',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => '邮件配置',
		'type' => 'heading');
	$options[] = array(
		'name' => 'SMTP服务',
		'desc' => '是否启用SMTP服务',
		'id' => 'mail_smtps',
		'std' => '0',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => '发信人',
		'desc' => '请填写发件人姓名',
		'id' => 'mail_name',
		'std' => 'Kratos',
		'type' => 'text');
	$options[] = array(
		'name' => '邮件服务器',
		'desc' => '请填写SMTP服务器地址',
		'id' => 'mail_host',
		'std' => 'smtp.vtrois.com',
		'type' => 'text');
	$options[] = array(
		'name' => '服务器端口',
		'desc' => '请填写SMTP服务器端口',
		'id' => 'mail_port',
		'std' => '994',
		'type' => 'text');
	$options[] = array(
		'name' => '邮箱帐号',
		'desc' => '请填写邮箱账号',
		'id' => 'mail_username',
		'std' => 'no_reply@vtrois.com',
		'type' => 'text');
	$options[] = array(
		'name' => '邮箱密码',
		'desc' => '请填写邮箱密码',
		'id' => 'mail_passwd',
		'std' => '123456789',
		'type' => 'text');
	$options[] = array(
		'name' => '启用SMTPAuth服务',
		'desc' => '是否启用SMTPAuth服务',
		'id' => 'mail_smtpauth',
		'std' => '1',
		'type' => 'checkbox'
	);
	$options[] = array(
		'name' => 'SMTPSecure设置',
		'desc' => '若启用SMTPAuth服务则填写ssl，若不启用则留空',
		'id' => 'mail_smtpsecure',
		'std' => 'ssl',
		'type' => 'text');

	$options[] = array(
		'name' => '广告配置',
		'type' => 'heading');
	$options[] = array(
		'name' => '广告位置',
		'desc' => '选择图片广告放置的位置',
		'id' => 'ad_show',
		'std' => array(
				'top' => 0,
				'footer' => 0),
		'type' => 'multicheck',
		'options' => array(
			'top' => '文章页顶部',
			'footer' => '文章页底部'));
	$options[] = array(
		'name' => '广告图片',
		'desc' => '图片宽度大于750px',
		'id' => 'ad_img',
		'type' => 'upload');
	$options[] = array(
		'name' => '广告代码',
		'desc' => '可放置浮动广告HTML代码',
		'id' => 'ad_code',
		'std' => '',
		'type' => 'textarea');
	return $options;
}