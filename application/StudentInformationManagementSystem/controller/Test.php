<?php
namespace app\StudentInformationManagementSystem\controller;
use app\StudentInformationManagementSystem\controller\Base;
class Test extends Base
{
	protected $is_check_login = ['test1'];
	protected $is_check_login = ['*'];//代表此类下面的全部方法都能必须要登录才能访问 这就是一个标志必须要登录才能进行访问的标志
	//这是用户登录才能访问的页面
    public function test1()
    {
    	return	$this->fetch();
    }
	//这是用户不用登录就能访问的页面
    public function test2()
    {
    	return	$this->fetch();
    }
}
?>