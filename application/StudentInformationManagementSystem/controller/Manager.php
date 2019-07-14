<?php

namespace app\StudentInformationManagementSystem\controller;

use think\Controller;
use think\Request;//变量获取
use app\StudentInformationManagementSystem\model\Manager as ManagerModer;//模型类
class manager extends Controller
{
    /**
     * 发送短信  并返回验证码或错误
     */
    public function sms()
    {
        header("Content-type: text/html; charset=utf-8");
		$phone = input('uPhone_Number');
        $rand = rand(1000, 9999);
//        $url = "api.chanyoo.cn/utf8/interface/send_sms.aspx?username=LuoDong&password=1121l10086&content=尊敬的用户：".$phone."，您正在操作实名认证，验证码：".$rand."，请及时提交完成认证，如不是本人操作请忽略！【学生信息后台权限管理系统】&receiver=".$phone;
        $url = "http://api.chanyoo.cn/utf8/interface/send_sms.aspx?username=LuoDong&password=1121l10086&content=尊敬的用户：" . $phone . "，您正在操作实名认证，验证码：" . $rand . "，请及时提交完成认证，如不是本人操作请忽略！【学生信息后台权限管理系统】&receiver=";
//        echo json_encode($url,JSON_UNESCAPED_UNICODE);//中文不转为unicode
        $file = file_get_contents($url);
        //转换xml结果
        $xml = simplexml_load_string($file);
        $data = json_decode(json_encode($xml), true);
        if ($data['result'] >= 0) {
            //存入数据库  【不建议】
//			1.发送验证码需要输入图片验证码【防止别人恶意调用】
//			2.验证码还是不要存数据库了，直接存入缓存，两分钟内有效，进行验证
//			3.不建议使用file_get_contents进行验证发送，一般都使用curl
            //存入redis
//            Ca::store('redis')->set("tel", $phone, 120);//两分钟后过期
            echo($rand);
        }else{
            echo("0");
        }
    }

    /**
     * 注册
     * @return mixed|void
     */
    public function register()
    {
        if (request()->isPost()) {//如果没有提交表单就跳转到登录页面 否则进行登录的验证
            $data = input('post.');
            $validate = \think\Loader::validate('Manager');
            if (!$validate->scene('add')->check($data)) {
                $this->error($validate->getError());
            }
            $Defence = new Denfence();//实例化当前的类【在本目录下的不用use引入 】
            //	安全防护开始
            $managerData = array();
            $managerData['tel'] = $Defence->clean_xss(input('post.tel')); //1.防注入代码
            $managerData['pas'] = $Defence->clean_xss(md5(input('post.pas')));
            //	安全防护结束
            $Manager = new ManagerModer();
            if ($Manager->addManager($managerData)) {
                $this->success("新增成功", 'Index/sign');
            } else {
                $this->error("新增失败", "Index/register");
            }
            return;
        }
        return $this->fetch();
    }

    /**
     * 修改管理员信息
     * @param $tel
     * @return mixed|void
     */
    public function modifyPas($tel)
    {
        if (!session('tel')) {
            $this->error('请先登录系统!', 'Index/sign');
        }
        if (request()->isPost()) {//如果没有提交表单就跳转到修改密码页面
            $data = input('post.');
            $validate = \think\Loader::validate('Manager');
            if (!$validate->scene('edit')->check($data)) {
                $this->error($validate->getError());
            }
            require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
            //	安全防护开始
            $managerData = array();
            $managerData['tel'] = clean_xss(input('post.tel')); //1.防注入代码
            $managerData['OldPas'] = clean_xss(md5(input('post.OldPas')));
            $managerData['NewPas'] = clean_xss(md5(input('post.NewPas')));
            //	安全防护结束
            $Manager = new ManagerModer();
            $result = $Manager->modifyManager($managerData);
            if ($result == 1) {
                $this->error("管理员账号不存在，请重新输入...");
            } else if ($result == 2) {
                $this->error("旧密码错误，即将跳转到修改密码界面...");
            } else {
                session(null);
                $this->success("恭喜您修改密码成功!请重新登录...", 'Index/sign');
            }
            return;

//		$result = ManagerModer::all();
//		foreach($result as $row){
//			if($row['uPhone_Number']==$tel){
//	//			echo($row['uPassword']."   ".md5($OldPas)."<br/>");//前面验证安全的时候已经加密了 这里不用再加密了
//				if($row['uPassword']==md5($OldPas)){
//					//修改密码
//					$user	=new ManagerModer(); //	save方法第二个参数为更新条件
//		   			$user->save(['uPassword'=>md5($NewPas)],['uPhone_Number'=>$tel]);
//		   			session_start();
//					//删除在数组和服务器端的session数据
//					$_SESSION = [];
//					session_destroy();
//	   				$this->success("恭喜您修改密码成功!请重新登录...",'Index/sign');  
//				}else{
//	   				$this->error("旧密码错误，即将跳转到修改密码界面...","ModifyPas");
//				}
//			}
//		}
            return;
        }
//  	$this->assign('name',session('tel'));
        $this->assign('name', $tel);
        return $this->fetch();
    }
}

?>