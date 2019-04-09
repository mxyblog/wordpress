window.onload = function(){

	//添加placeholder
	var name = document.getElementById("user_login");
	var psw = document.getElementById("user_pass");
	name.setAttribute("placeholder","请输入用户名");
	psw.setAttribute("placeholder","请输入密码");

	// 隐藏label
	var form = document.getElementById("loginform");
	var labels = form.getElementsByTagName("label");
	var userlabel = form.getElementsByTagName("label")[0];
	var passlabel = form.getElementsByTagName("label")[1];
	userlabel.removeChild(userlabel.firstChild);
	passlabel.removeChild(passlabel.firstChild);
}