//适应网页大小开始
//浏览器窗口大小被改变时触发事件
window.onresize = function() {
	layer(); //动态改变遮罩大小
	//动态改变弹窗位置
	setPosition();
}
//动态改变遮罩大小
function layer() {
	var doc = document.documentElement;
	relHeight = (doc.clientHeight > doc.scrollHeight) ? doc.clientHeight : doc.scrollHeight; //获取屏幕高度和当前页面高度中的较大值
	document.getElementById('Layer').style.height = relHeight + 'px';
	relWidth = (doc.clientWidth > doc.scrollWidth) ? doc.scrollWidth : doc.clientWidth; //获取屏幕宽度和当前页面宽度中的较小值
	document.getElementById('Layer').style.width = relWidth + 'px';
//		alert("最大高度："+relHeight+"最小宽度"+relWidth);
}
layer();
function setPosition() {
	var doc = document.documentElement;
	//获得窗口的垂直位置; 
	var iTop = (doc.clientHeight - 8 - document.getElementById('login').offsetHeight) / 2;
	//获得窗口的水平位置;  
	var iLeft = (doc.clientWidth - 5 - document.getElementById('login').offsetWidth) / 2;
	$(login).css({
		'top': iTop,
		'left': iLeft
	});
}
setPosition();
//适应网页大小结束
document.getElementById("txt_1").value = document.getElementById("phone").innerHTML;

function check() {
	/*获取表单元素和提示信息*/
	var email = document.getElementById('txt_1').value;
	var password = document.getElementById('txt_2').value;
	var emailinfo = document.getElementById('txt_1info');
	var passwordinfo = document.getElementById('txt_2info');
	var password2 = document.getElementById('txt_3').value;
	var passwordinfo2 = document.getElementById('txt_3info');
	var password3 = document.getElementById('txt_4').value;
	var passwordinfo3 = document.getElementById('txt_4info');
	/*定义变量返回错误*/
	var a = 1;
	var b = 1;
	var c = 1;
	var d = 1;
	/*定义变量返回错误*/
	/*验证账号*/
	var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;
if(!myreg.test(email)) {
	emailinfo.innerHTML = "格式错误";
	b = 0;
}
/*验证密码*/
if(password == "") {
	passwordinfo.innerHTML = "格式错误";
	c = 0;
} else if(password.length < 6) {
	passwordinfo.innerHTML = "格式错误";
	c = 0;
}
if(password2 == "") {
	passwordinfo2.innerHTML = "格式错误";
	passwordinfo2.style.color = "red";
	d = 0;
} else if(password2.length < 6) {
	passwordinfo2.innerHTML = "格式错误";
	passwordinfo2.style.color = "red";
	d = 0;
} else if(password != password2) {
	passwordinfo2.innerHTML = "格式错误";
	passwordinfo2.style.color = "red";
	d = 0;
}
if(password3 == "") {
	passwordinfo3.innerHTML = "格式错误";
	a = 0;
} else if(password3.length < 6) {
	passwordinfo3.innerHTML = "格式错误";
	a = 0;
}
/*定义变量返回错误*/
if(a == "0" || b == "0" || c == "0" || d == "0") {
	return false;
}
/*定义变量返回错误*/
}

function checkemail() {
	var email = document.getElementById('txt_1').value;
	var emailinfo = document.getElementById('txt_1info');
	var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;
if(!myreg.test(email)) {
	emailinfo.innerHTML = "格式错误";
	emailinfo.style.color = "red";
	return false;
} else {
	emailinfo.innerHTML = "格式正确";
	emailinfo.style.color = "green";
	return true;
}
}

function checkpassword1() {
	var password1 = document.getElementById('txt_2').value;
	var passwordinfo1 = document.getElementById('txt_2info');
	if(password1 == "") {
		passwordinfo1.innerHTML = "格式错误";
		passwordinfo1.style.color = "red";
		return false;
	} else if(password1.length < 6) {
		passwordinfo1.innerHTML = "格式错误";
		passwordinfo1.style.color = "red";
		return false;
	} else {
		passwordinfo1.innerHTML = "格式正确";
		passwordinfo1.style.color = "green";
	}
}

function checkpassword2() {
	var password1 = document.getElementById('txt_2').value;
	var password2 = document.getElementById('txt_3').value;
	var passwordinfo2 = document.getElementById('txt_3info');
	if(password2 == "") {
		passwordinfo2.innerHTML = "格式错误";
		passwordinfo2.style.color = "red";
		return false;
	} else if(password2.length < 6) {
		passwordinfo2.innerHTML = "格式错误";
		passwordinfo2.style.color = "red";
		return false;
	} else if(password1 != password2) {
		passwordinfo2.innerHTML = "格式错误";
		passwordinfo2.style.color = "red";
		return false;
	} else {
		passwordinfo2.innerHTML = "格式正确";
		passwordinfo2.style.color = "green";
	}
}

function checkpassword3() {
	var password4 = document.getElementById('txt_4').value;
	var passwordinfo4 = document.getElementById('txt_4info');
	if(password4 == "") {
		passwordinfo4.innerHTML = "格式错误";
		passwordinfo4.style.color = "red";
		return false;
	} else if(password4.length < 6) {
		passwordinfo4.innerHTML = "格式错误";
		passwordinfo4.style.color = "red";
		return false;
	} else {
		passwordinfo4.innerHTML = "格式正确";
		passwordinfo4.style.color = "green";
	}
}
