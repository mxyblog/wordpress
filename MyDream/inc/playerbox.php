<style>
#bgm{
	height:<?php echo md_get_option('playerbox-height') ?>px;
	width:<?php echo md_get_option('playerbox-width') ?>px;
	background-color:<?php echo md_get_option('playerbox-background-color') ?>
}
</style>
<script type="text/javascript">  
    $(function () {  
		$('#bgmsw').click(function (event) {  
		//取消事件冒泡  
			event.stopPropagation();  
			//设置弹出层的位置  
			var offset = $(event.target).offset();  
			$('#bgm').css({ 
				bottom: offset.bottom + $(event.target).height() + "px",
				left: offset.left
				});  
			//按钮的toggle,如果div是可见的,点击按钮切换为隐藏的;如果是隐藏的,切换为可见的。  
			$('#bgm').toggle('slow');  
		});  
		//点击空白处或者自身隐藏弹出层，下面分别为滑动和淡出效果。  
		$(document).click(function (event) { $('#bgm').slideUp('slow') });  
		$('#bgm').click(function (event) { $(this).fadeOut(800) });  
    })  
</script>
<div id="bgmbox">
	<div id="bgmsw">
		<div class="bgmplay"><i class="iconfont icon-imagefiltervintage icon-spin"></i></div>
	</div>
	<div id="bgm">
		<?php echo md_get_option('playerbox-code') ?>
	</div>
</div>  