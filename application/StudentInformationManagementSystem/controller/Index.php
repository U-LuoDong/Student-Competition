<?php

namespace app\StudentInformationManagementSystem\controller;

use think\Controller;
use think\Request;//变量获取
use app\StudentInformationManagementSystem\model\Manager as ManagerModer;//模型类class Index extends Controller
class Index extends Controller
{
    //登录页面开始
    /**
     * 密码登录
     * @return \think\response\View|void
     */
    public function sign()
    {
        if (request()->isPost()) {//如果没有提交表单就跳转到登录页面 否则进行登录的验证
//			require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
            $Defence = new Denfence();//实例化当前的类【在本目录下的不用use引入 】
            //	安全防护开始
            $managerData = array();
            $managerData['tel'] = $Defence->clean_xss(input('post.tel')); //1.防注入代码
            $managerData['pas'] = $Defence->clean_xss(input('post.pas'));
            //	安全防护结束
            $user = new ManagerModer();
            $result = $user->getManager($managerData);
            if ($result == 1) {
                $this->error("登陆账号不存在，请重新登录...");
            } else {
                if ($result == 2) {
                    $this->error("密码不正确，请重新登录...");
                } else {
                    if (input('post.category')) {//没有保持登录状态  那么每次需要重新登录
                        session('tel', $managerData['tel']);
                        $this->success("登陆成功", 'Student/index');
                    }
                }
            }

            return;
        }

//  	return	$this->fetch();
        return view();//用这个助手函数更加简洁  还不要用controller类
    }

    /**
     * @return \think\response\View|void
     * 手机验证码登录
     */
    public function useCode()
    {
        if (request()->isPost()) {//如果没有提交表单就跳转到登录页面 否则进行登录的验证
            $Defence = new Denfence();//实例化当前的类【在本目录下的不用use引入 】
            //	安全防护开始
            $managerData = array();
            $managerData['tel'] = $Defence->clean_xss(input('post.tel')); //1.防注入代码
            $managerData['tel_code'] = $Defence->clean_xss(input('post.tel_code')); //1.防注入代码
            //	安全防护结束
            $user = new ManagerModer();
            $result = $user->getManagerByCode($managerData);
            if ($result == 0) {
                $this->error("登陆账号不存在，请重新登录...");
            } else {
                if ($result == -2) {
                    $this->error("手机验证码已过期，请重新登录...");
                } else {
                    if ($result == -1) {
                        $this->error("手机验证码不正确，请重新登录...");
                    } else {
                        if ($result == 1) {
                            if (input('post.category')) {//没有保持登录状态  那么每次需要重新登录
                                session('tel', $managerData['tel']);
                                $this->success("登陆成功", 'Student/index');
                            }
                        }
                    }
                }
            }

            return;
        }

        return view();//用这个助手函数更加简洁  还不要用controller类
    }

    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 检查账号是否存在
     */
    public function checkAccount()
    {
        $Defence = new Denfence();//实例化当前的类【在本目录下的不用use引入 】
        //	安全防护开始
        $managerData = array();
        $managerData['tel'] = $Defence->clean_xss(input('post.tel')); //1.防注入代码
        //	安全防护结束
        $user = new ManagerModer();
        $result = $user->checkAccount($managerData);
        if ($result == 1) {
            echo("1");
        } else {
            echo("0");
        }
    }
    //登录页面结束

    //注销登录
    public function LogoutLogin()
    {
        session(null);
        $this->success("注销登陆成功!即将跳转到登录页面...", 'sign');
    }
}
