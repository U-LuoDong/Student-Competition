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
	var iTop = (doc.clientHeight - 6 - document.getElementById('login').offsetHeight) / 2;
	//获得窗口的水平位置;  
	var iLeft = (doc.clientWidth - 5 - document.getElementById('login').offsetWidth) / 2;
	$(login).css({
		'top': iTop,
		'left': iLeft
	});
}
setPosition();
//适应网页大小结束

//异步获取验证码
function getCode() {
	$.ajax({
		url: 'http://www.tp5.com/studentinformationmanagementsystem/getCode.php',
		type: 'POST',
		dataType: 'json',
		success: function(msg) {
			// alert(msg);
			document.getElementById("code_1").value = msg;
		}
	});
}
getCode();
//刷新验证码
function shuaxin() {
	document.getElementById('code').src = "http://www.tp5.com/studentinformationmanagementsystem/VerificationCode.php?" + Math.random();
	var code = getCode();
	document.getElementById("code_1").value = code;
}

function check() {
	/*获取表单元素和提示信息*/
	var email = document.getElementById('txt_1').value.trim(); //去掉用户输入的空格
	var password = document.getElementById('txt_2').value.trim();
	var code_content = document.getElementById('code_content').value.trim();
	var emailinfo = document.getElementById('txt_1info');
	var passwordinfo = document.getElementById('txt_2info');
	var code_info = document.getElementById('code_info');
	/*定义变量返回错误*/
	var a = 1;
	var b = 1;
	var c = 1;
	/*定义变量返回错误*/
	/*验证账号*/
	var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;
	if(!myreg.test(email)) {
		emailinfo.innerHTML = "格式错误";
		a = 0;
	}
	/*验证密码*/
	if(password == "") {
		passwordinfo.innerHTML = "格式错误";
		b = 0;
	} else if(password.length < 6) {
		passwordinfo.innerHTML = "格式错误";
		b = 0;
	}
	//				验证验证码
	if(code_content.toLowerCase() != document.getElementById("code_1").value.toLocaleLowerCase()) { //忽略大小写  全部转化为小写：toLowerCase
		code_info.innerHTML = "验证码错误";
		c = 0;
	}
	/*定义变量返回错误*/
	if(a == "0" || b == "0" || c == "0") {
		return false;
	}
	/*定义变量返回错误*/
}

function checkemail() {
	var email = document.getElementById('txt_1');
	var emailinfo = document.getElementById('txt_1info');
	var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;
	if(!myreg.test(email.value.trim())) {
		emailinfo.innerHTML = "格式错误"; //手机格式有误
		//					email.placeholder="手机格式有误";
		emailinfo.style.color = "red";
		return false;
	} else {
		emailinfo.innerHTML = "格式正确";
		emailinfo.style.color = "green";
		return true;
	}
}

function checkpassword() {
	var password = document.getElementById('txt_2').value.trim();
	var passwordinfo = document.getElementById('txt_2info');
	if(password == "") {
		passwordinfo.innerHTML = "格式错误";
		passwordinfo.style.color = "red";
		return false;
	} else if(password.length < 6) {
		passwordinfo.innerHTML = "格式错误";
		passwordinfo.style.color = "red";
		return false;
	} else {
		passwordinfo.innerHTML = "格式正确";
		passwordinfo.style.color = "green";
	}
}