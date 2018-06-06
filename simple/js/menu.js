var isOpen = false;
function animateShow(){
	$(".menubox").animate({
		height:'162px',
		opacity:'1',
	},300);
}
function animateHide(){
	$(".menubox").animate({
		height:'0px',
		opacity:'0',
	},300);
}
//点击非菜单区域关闭菜单
$('body').on('click',function () {
	if (isOpen) {
		animateHide();
		isOpen = false;
		return;
	}
});


// 点击按钮区打开菜单
$('.menu').on('click',function (e) {
	e.stopPropagation();
	if (isOpen) {
		animateHide();
		isOpen = false;
		return;
	}
	isOpen = true;
	animateShow();
});


//点击菜单区域不能关闭菜单
$(".menubox").on('click',function(e){
	e.stopPropagation();
	if (isOpen)  return;
});


//点击close按钮关闭菜单
$(".menu-close").click(function(){
	if(isOpen){
		animateHide();
		isOpen = false;
		return;
	}
});