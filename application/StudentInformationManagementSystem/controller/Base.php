<?php
namespace app\StudentInformationManagementSystem\controller;
use think\Controller;
use think\Request;
class Base extends Controller
{
//	法一
	//初始化方法
	public function _initialize()
	{
		if(!session('tel')){
			$this->error('请先登录系统!','Index/sign');
		}
	}
	
//	法二
	//用来存放用户登录之后才能操作的方法的集合
	protected $is_check_login = [' '];
	//初始化方法
//	public function _initialize()
//	{
//		//如果用户没有登录 并且其操作需要登录 那么就跳转到登录界面
//		if(!$this->isLogin()&& (in_array(Request::instance()->action(),$this->is_check_login)||$this->is_check_login[0]=="*")){//in_array判断第一个参数是否在数组中
//			return	$this->error('请先登录系统!','Index/sign');
//		}
//	}
	
	public function isLogin()
	{
		// 判断（当前作用域）是否赋值
		session('?tel');
	}
}
?>