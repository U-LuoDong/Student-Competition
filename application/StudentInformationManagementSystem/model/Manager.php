<?php
namespace app\StudentInformationManagementSystem\model;
use think\Model;
use traits\model\SoftDelete;
class manager extends Model//这里的模型类名要和数据库中的表名对应
{
//软删除
	use SoftDelete;
	protected static $deleteTime='delete_time';
//	自动将密码加密
//	protected $auto=['uPassword'];
//	protected function setuPasswordAttr($value)
//	{
//		return md5($value);
//	}

	//增加管理员
	public function addManager($data){
	    if(empty($data) || !is_array($data)){
	        return false;
	    }
	    $this->uPhone_Number=$data['tel'];
		$this->uPassword=$data['pas'];
	    if($this->save()){
	        return true;
	    }else{
	        return false;
	    }
	    //或者
//	    $adminData=array();
//	    $adminData['uPhone_Number']=$data['tel'];
//	    $adminData['uPassword']=$data['pas'];
//	    if($this->save($adminData)){
//	        return true;
//	    }else{
//	        return false;
//	    }
	    
				   	//法一
//		   	$Manager=new ManagerModer();
//		   	$Manager->uPhone_Number=$tel;
//		   	$Manager->uPassword=$pas;
//			if($Manager->save()){
//			   	$this->success("新增成功",'Index/sign');  
//			}else{
//			   	$this->error("新增失败","Index/register");
//			}
			//法二
		// 	$Manager=new ManagerModer(input('post.'));
		//	$ret = $Manager->allowField(true)->save();//用这个注册后账号和密码位空 是不是作为非数据表字段给我过滤掉了？？
		////	$ret = $Manager->allowField(['tel','pas'])->save();//这个直接报错
		//  if($ret){
		// 		$this->success("恭喜您注册成功",'Index/sign');  
		// 	}else{
		// 		$this->error("用户注册失败","Index/register");
		// 	}
   }
   
   //获取管理员 实现登录
   public function getManager($data){
   	$result = $this->where('uPhone_Number',$data['tel'])->find();
	if($result){
	   	if($result['uPassword'] == md5($data['pas'])){
	   		return 3;  
	   	} else{
	   		return 2;
	   	}   				
	// 		if(captcha_check(input('post.code'))){
	// 			$this->success("登陆成功",'index');  
	// 		}else{
	// 			$this->error("验证码不正确，请重新登录...");
	// 		}
	}else{
	   		return 1;
	}
	
				//另一种方法
				//		$result = ManagerModer::all();
				//		foreach($result as $row){
				//			if($row['uPhone_Number']==$tel&&$row['uPassword']==md5($pas)){
				//				if(input('post.category')){//没有保持登录状态  那么每次需要重新登录
				//					session_start();
				//					$_SESSION['tel']=$tel;
				//				}
				// 				$this->success("登陆成功",'index');  
				//			}
				//		}
				// 		$this->error("登陆账号或密码有误，请重新登录！");
   }

    /**
     * @param $data
     * @return int
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 通过手机验证码进行登录
     */
    public function getManagerByCode($data){
        $result = $this->where('uPhone_Number',$data['tel'])->find();
        if($result){
            //如果没有过期就返回就进行对比
            if(Ca::store('redis')->has("tel")){
                if($data['tel_code']==Ca::store('redis')->get("tel")){
                    return 1;
                }else{
                    return -1;//手机验证码不对
                }
            }else{
                return -2;//验证码过期
            }
        }else{
            return 0;//账号不存在
        }
    }


   //修改管理员信息
   public function modifyManager($data){
   	$result = $this->where('uPhone_Number',$data['tel'])->find();
   	//考虑密码为空  如果密码为空的话那么就默认不改变密码
	if(!$data['OldPas']){
        $data['password']=$result['uPassword'];
    }
	if($result){
	   	if($result['uPassword'] == $data['OldPas']){
		    $this->save(['uPassword'=>$data['NewPas']],['uPhone_Number'=>$data['tel']]);
	   		return 3;  
	   	} else{
	   		return 2;
	   	}   				
	// 		if(captcha_check(input('post.code'))){
	// 			$this->success("登陆成功",'index');  
	// 		}else{
	// 			$this->error("验证码不正确，请重新登录...");
	// 		}
	}else{
	   		return 1;
	}
	
				//另一种方法
				//		$result = ManagerModer::all();
				//		foreach($result as $row){
				//			if($row['uPhone_Number']==$tel&&$row['uPassword']==md5($pas)){
				//				if(input('post.category')){//没有保持登录状态  那么每次需要重新登录
				//					session_start();
				//					$_SESSION['tel']=$tel;
				//				}
				// 				$this->success("登陆成功",'index');  
				//			}
				//		}
				// 		$this->error("登陆账号或密码有误，请重新登录！");
   }

    /**
     * @param $data
     * @return int
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 判断输入账号是否存在
     */
    public function checkAccount($data){
        $result = $this->where('uPhone_Number',$data['tel'])->find();
        if($result){
            return 1;
        }else{
            return 0;
        }
    }
}
?>