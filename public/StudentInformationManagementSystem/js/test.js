//浏览器窗口大小被改变时触发事件
window.onresize = function() {
	layer(); //动态改变遮罩大小
	//动态改变弹窗位置
	setPosition1();
	setPosition2();
	setPosition3();
}
//动态改变遮罩大小
function layer() {
	var doc = document.documentElement;
	relHeight = (doc.clientHeight > doc.scrollHeight) ? doc.clientHeight : doc.scrollHeight; //获取屏幕高度和当前页面高度中的较大值
	document.getElementById('Layer').style.height = relHeight + 'px';
	relWidth = (doc.clientWidth > doc.scrollWidth) ? doc.scrollWidth : doc.clientWidth; //获取屏幕宽度和当前页面宽度中的较小值
	document.getElementById('Layer').style.width = relWidth + 'px';
	//	alert("最大高度："+relHeight+"最小宽度"+relWidth);
}
layer();
//Function_1开始 获取select当前的文本内容以及更新相应的班级
//获得下拉框的节点对象开始
var Function_1_sp_se = document.getElementById("Function_1_sp"); //获取专业的select
var Function_1_class_se = document.getElementById("Function_1_class"); //获取班级的select
var ZYoptions = Function_1_sp_se.options; //获得该下拉框所有的option的节点对象  得到的options是一个对象数组
var BJoptions = Function_1_class_se.options;
var ZYselectedText = ZYoptions[0].text; //1.初始化专业的值
var BJselectedText = BJoptions[0].text; //1.初始化班级的值
if(ZYselectedText != "该项表示不对专业进行查询") {
	GeneratClass(); //异步更新专业对应的班级
}
//获得下拉框的节点对象结束

function F1_ChangeSP() { //2.内容改变  改变相应的初始值和异步
	var index = Function_1_sp_se.selectedIndex; //获得当前选中的option的索引
	ZYselectedText = ZYoptions[index].text; //更新专业的值
	BJselectedText = BJoptions[0].text; //初始化班级的值
	//				alert(ZYselectedText);
	Function_1_class_se.options.length = 1; //删除班级select中的值  但是保留一个值
	if(ZYselectedText != "该项表示不对专业进行查询") {
		GeneratClass(); //异步更新专业对应的班级
	}
}

function F1_ChangeCl() { //2.内容改变  改变相应的初始值
	var index = Function_1_class_se.selectedIndex; //获得当前选中的option的索引
	BJselectedText = BJoptions[index].text; //更新班级的值
	//						alert(BJselectedText);
}
//Function_1结束

//Function_3开始
var Function_3_class_se = document.getElementById("Function_3_cl"); //获取专业的select
var F3_BJoptions = Function_3_class_se.options;
var F3_BJselectedText = F3_BJoptions[0].text; //1.初始化班级的值
function F3_ChangeCl() { //2.内容改变  改变相应的初始值
	var index = Function_3_class_se.selectedIndex; //获得当前选中的option的索引
	F3_BJselectedText = F3_BJoptions[index].text; //更新专业的值
}
//Function_3结束

//三大功能模块的显示开始
var Function_1_info = document.getElementById('Function_1_info');
var Function_2_info = document.getElementById('Function_2_info');
var Function_3_info = document.getElementById('Function_3_info');

//让弹窗永远显示在中间开始
Function_1_info.style.display = 'block';
Function_2_info.style.display = 'block';
Function_3_info.style.display = 'block';

function setPosition1() {
	var doc = document.documentElement;
	//获得窗口的垂直位置; 
	var iTop = (doc.clientHeight - 8 - Function_1_info.offsetHeight) / 2;
	//获得窗口的水平位置;  
	var iLeft = (doc.clientWidth - 5 - Function_1_info.offsetWidth) / 2;
	$(Function_1_info).css({
		'top': iTop,
		'left': iLeft
	});
}

function setPosition2() {
	var doc = document.documentElement;
	//获得窗口的垂直位置; 
	var iTop = (doc.clientHeight - 8 - Function_2_info.offsetHeight) / 2;
	//获得窗口的水平位置;  
	var iLeft = (doc.clientWidth - 5 - Function_2_info.offsetWidth) / 2;
	$(Function_2_info).css({
		'top': iTop,
		'left': iLeft
	});
}
//因为Function_3_info高度的原因  不用适配其高度
function setPosition3() {
	var doc = document.documentElement;
	//获得窗口的水平位置;
	var iLeft = (doc.clientWidth - 5 - Function_3_info.offsetWidth) / 2;
	$(Function_3_info).css({
		'left': iLeft
	});
}
setPosition1();
setPosition2();
setPosition3();
Function_1_info.style.display = 'none';
Function_2_info.style.display = 'none';
Function_3_info.style.display = 'none';
//让弹窗永远显示在中间结束

var layer1 = document.getElementById('Layer');

function out1() {
	Function_1_info.style.display = 'block';
	layer1.style.display = 'block';
	setPosition1();
	GeneratNum(); //异步生成人数
}

function close1() {
	Function_1_info.style.display = 'none';
	layer1.style.display = 'none';
}

function out2() {
	Function_2_info.style.display = 'block';
	layer1.style.display = 'block';
	$("#Function_2_t tbody").html(""); //将原先的内容删除
	setPosition2();
	GeneratSp(); //异步生成专业
}

function close2() {
	Function_2_info.style.display = 'none';
	layer1.style.display = 'none';
}

function out3() {
	Function_3_info.style.display = 'block';
	layer1.style.display = 'block';
//	$("#Function_3_t tbody").html(""); //将原先的内容删除
	setPosition3();
//	GeneratSc(); //异步生成班级
}

function close3() {
	Function_3_info.style.display = 'none';
	layer1.style.display = 'none';
}
//三大功能模块的显示结束

//异步提交function_1中的专业 生成对应班级
function GeneratClass() {
	$.ajax({
		url: 'http://www.tp5.com/studentinformationmanagementsystem/student/function_1_Class.html',
		type: 'POST',
		dataType: 'json',
		data: {
			data: ZYselectedText
		},
		success: function(msg) {
			var i;
			for(i = 0; i < msg.length; i++) {
				var Option = document.createElement("option");
				var content = document.createTextNode(msg[i]);
				Option.appendChild(content);
				Function_1_class_se.appendChild(Option);
			}
		}
	});
}

//异步生成专业、班级对应的人数
function GeneratNum() {
	$.ajax({
		url: 'http://www.tp5.com/studentinformationmanagementsystem/student/function_1.html',
		type: 'POST',
		dataType: 'json',
		data: {
			//这里是请求参数，前面是键名，后面是值
			zy: ZYselectedText,
			bj: BJselectedText,
		},
		success: function(msg) {
			if(BJselectedText != '该项表示不对班级进行查询' && ZYselectedText != '该项表示不对专业进行查询') {
				var Select = document.getElementById("Function_1_specialty").innerHTML = ZYselectedText;
				var Select = document.getElementById("Function_1_cl").innerHTML = BJselectedText;
				var Select = document.getElementById("Function_1_number").innerHTML = msg;
			} else if(BJselectedText == '该项表示不对班级进行查询' && ZYselectedText != '该项表示不对专业进行查询') {
				//对专业进行查询  而不对班级进行查询 
				var Select = document.getElementById("Function_1_specialty").innerHTML = ZYselectedText;
				var Select = document.getElementById("Function_1_cl").innerHTML = "";
				var Select = document.getElementById("Function_1_number").innerHTML = msg;
			} else {
				//专业班级都不进行查询
				var Select = document.getElementById("Function_1_specialty").innerHTML = "计算机科学与技术系";
				var Select = document.getElementById("Function_1_cl").innerHTML = "";
				var Select = document.getElementById("Function_1_number").innerHTML = msg;
			}
		}
	});
}

//异步生成系部对应的专业
function GeneratSp() {
	$.ajax({
		url: 'http://www.tp5.com/studentinformationmanagementsystem/student/function_2.html',
		type: 'POST',
		dataType: 'json',
		data: {
			//这里是请求参数，前面是键名，后面是值
			xb: '计算机科学与技术系',
		},
		success: function(msg) {
			//					alert(msg.length);
			var tb = document.getElementById("Function_2_tb");
			//每次装一个序号和专业
			var i;
			for(i = 0; i < msg.length; i++) {
				var tr = document.createElement("tr");
				var td_num = document.createElement("td");
				var td_spe = document.createElement("td");
				var num = document.createTextNode(i + 1);
				var spe = document.createTextNode(msg[i]);
				td_num.appendChild(num);
				td_spe.appendChild(spe);
				tr.appendChild(td_num);
				tr.appendChild(td_spe);
				tb.appendChild(tr);
				tr.className = 'active';
			}
		}
	});
}

//异步生成专业对应的班级
function GeneratSc() {
	$.ajax({
		url: 'http://www.tp5.com/studentinformationmanagementsystem/student/function_3.html',
		type: 'POST',
		dataType: 'json',
		data: {
			//这里是请求参数，前面是键名，后面是值
			sc: F3_BJselectedText,
		},
		success: function(msg) {
			//									alert(msg.length);
			var tb = document.getElementById("Function_3_tb");
			document.getElementById("Function_3_class").innerHTML = F3_BJselectedText; //添加班级信息
			//每次分别装一个序号和班级
			var i;
			for(i = 0; i < msg.length; i++) {
				if((i + 2) % 2 == 0) { //如果是2的倍数 那么就要重新创建一个新tr
					var tr = document.createElement("tr");
				}
				var td_num = document.createElement("td");
				var td_scl = document.createElement("td");
				var num = document.createTextNode(i + 1);
				var scl = document.createTextNode(msg[i]);
				td_num.appendChild(num);
				td_scl.appendChild(scl);
				tr.appendChild(td_num);
				tr.appendChild(td_scl);
				tb.appendChild(tr);
				tr.className = 'active';
			}
		}
	});
}