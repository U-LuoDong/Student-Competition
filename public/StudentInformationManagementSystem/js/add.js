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
//提交表单验证函数
function check() {
	/*获取表单元素和提示信息开始*/
	var num = document.getElementById('txt_1').value.trim();
	var numInfo = document.getElementById('txt_1info');
	var grade = document.getElementById('txt_2').value.trim();
	var gradeInfo = document.getElementById('txt_2info');
	var Class = document.getElementById('txt_3').value.trim();
	var ClassInfo = document.getElementById('txt_3info');
	var sid = document.getElementById('txt_4').value.trim();
	var sidInfo = document.getElementById('txt_4info');
	var sname = document.getElementById('txt_5').value.trim();
	var snameInfo = document.getElementById('txt_5info');
	var sex = document.getElementById('txt_6').value.trim();
	var sexInfo = document.getElementById('txt_6info');
	var level = document.getElementById('txt_7').value.trim();
	var levelInfo = document.getElementById('txt_7info');
	/*获取表单元素和提示信息结束*/

	/*定义变量返回错误*/
	var a = 1;
	var b = 1;
	var c = 1;
	var d = 1;
	var e = 1;
	var f = 1;
	var g = 1;
	/*定义变量返回错误*/

	/*验证序号*/
	var myreg = /\d+/;
	if(!myreg.test(num)) {
		numInfo.innerHTML = "格式错误";
		a = 0;
	}
	//				验证年级
	myreg = /^\d{4}$/;
	if(!myreg.test(grade)) {
		gradeInfo.innerHTML = "格式错误";
		gradeInfo.style.color = "red";
		b = 0;
	} else {
		gradeInfo.innerHTML = "格式正确";
		gradeInfo.style.color = "green";
	}
	//				验证班级
	myreg = /.+/;
	if(!myreg.test(Class)) {
		ClassInfo.innerHTML = "格式错误";
		ClassInfo.style.color = "red";
		c = 0;
	} else {
		ClassInfo.innerHTML = "格式正确";
		ClassInfo.style.color = "green";
	}
	//				验证学号
	myreg = /^\d{11}$/;
	if(!myreg.test(sid)) {
		sidInfo.innerHTML = "格式错误";
		sidInfo.style.color = "red";
		d = 0;
	} else {
		sidInfo.innerHTML = "格式正确";
		sidInfo.style.color = "green";
	}
	//				验证姓名
	myreg = /.+/;
	if(!myreg.test(sname)) {
		snameInfo.innerHTML = "格式错误";
		snameInfo.style.color = "red";
		e = 0;
	} else {
		snameInfo.innerHTML = "格式正确";
		snameInfo.style.color = "green";
	}
	//				验证性别
	myreg = /^[\u4e00-\u9fa5]$/;
	if(!myreg.test(sex)) {
		sexInfo.innerHTML = "格式错误";
		sexInfo.style.color = "red";
		f = 0;
	} else {
		sexInfo.innerHTML = "格式正确";
		sexInfo.style.color = "green";
	}
	//				验证层次
	myreg = /^[\u4e00-\u9fa5]{2}$|^[\u4e00-\u9fa5]{3}$/;
	if(!myreg.test(level)) {
		levelInfo.innerHTML = "格式错误";
		levelInfo.style.color = "red";
		g = 0;
	} else {
		levelInfo.innerHTML = "格式正确";
		levelInfo.style.color = "green";
	}
	/*定义变量返回错误*/
	if(a == "0" || b == "0" || c == "0" || d == "0" || e == "0" || f == "0" || g == "0") {
		return false;
	}
	/*定义变量返回错误*/
}

//			验证序号函数
function checkNum() {
	var num = document.getElementById('txt_1').value.trim();
	var numInfo = document.getElementById('txt_1info');
	var myreg = /\d+/;
	if(!myreg.test(num)) {
		numInfo.innerHTML = "格式错误";
		numInfo.style.color = "red";
		return false;
	} else {
		numInfo.innerHTML = "格式正确";
		numInfo.style.color = "green";
		return true;
	}
}

//验证年级函数
function checkGrade() {
	var grade = document.getElementById('txt_2').value.trim();
	var gradeInfo = document.getElementById('txt_2info');
	//正则表达式:只能输入4个数字
	var myreg = /^\d{4}$/;
	if(!myreg.test(grade)) {
		gradeInfo.innerHTML = "格式错误";
		gradeInfo.style.color = "red";
		return false;
	} else {
		gradeInfo.innerHTML = "格式正确";
		gradeInfo.style.color = "green";
		return true;
	}
}


//验证班级函数
function checkClass() {
	var Class = document.getElementById('txt_3').value.trim();
	var ClassInfo = document.getElementById('txt_3info');
	//正则表达式匹配任意数量的字符
	var myreg = /.+/;
	if(!myreg.test(Class)) {
		ClassInfo.innerHTML = "格式错误";
		ClassInfo.style.color = "red";
		return false;
	} else {
		ClassInfo.innerHTML = "格式正确";
		ClassInfo.style.color = "green";
		return true;
	}
}

//验证学号函数
function checkSid() {
	var sid = document.getElementById('txt_4').value.trim();
	var sidInfo = document.getElementById('txt_4info');
	//正则表达式:11位数字
	var myreg = /^\d{11}$/;
	if(!myreg.test(sid)) {
		sidInfo.innerHTML = "格式错误";
		sidInfo.style.color = "red";
		return false;
	} else {
		sidInfo.innerHTML = "格式正确";
		sidInfo.style.color = "green";
		return true;
	}
}

//验证姓名函数
function checkSname() {
	var sname = document.getElementById('txt_5').value.trim();
	var snameInfo = document.getElementById('txt_5info');
	//正则表达式匹配任意数量的字符
	var myreg = /.+/;
	if(!myreg.test(sname)) {
		snameInfo.innerHTML = "格式错误";
		snameInfo.style.color = "red";
		return false;
	} else {
		snameInfo.innerHTML = "格式正确";
		snameInfo.style.color = "green";
		return true;
	}
}

//验证性别函数
function checkSex() {
	var sex = document.getElementById('txt_6').value.trim();
	var sexInfo = document.getElementById('txt_6info');
	//正则表达式匹配1个汉字
	var myreg = /^[\u4e00-\u9fa5]$/;
	if(!myreg.test(sex)) {
		sexInfo.innerHTML = "格式错误";
		sexInfo.style.color = "red";
		return false;
	} else {
		sexInfo.innerHTML = "格式正确";
		sexInfo.style.color = "green";
		return true;
	}
}

//验证层次函数
function checkLevel() {
	var level = document.getElementById('txt_7').value.trim();
	var levelInfo = document.getElementById('txt_7info');
	//正则表达式匹配2个或者3个汉字
	var myreg = /^[\u4e00-\u9fa5]{2}$|^[\u4e00-\u9fa5]{3}$/;
	if(!myreg.test(level)) {
		levelInfo.innerHTML = "格式错误";
		levelInfo.style.color = "red";
		return false;
	} else {
		levelInfo.innerHTML = "格式正确";
		levelInfo.style.color = "green";
		return true;
	}
}
