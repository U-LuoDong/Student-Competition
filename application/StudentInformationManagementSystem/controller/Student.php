<?php
namespace app\StudentInformationManagementSystem\controller;
use app\StudentInformationManagementSystem\controller\Base;
use think\Db;
use think\Request;//变量获取
use app\StudentInformationManagementSystem\model\Student as StudentModer;//模型类
class student extends Base
{
	//首页
    public function index()
    {
//  	session_start();
//  	$tel=$_SESSION['tel'];
//		if(!$tel){
// 			$this->error("请先登录系统!","sign");
//		}
    	$this->assign('name',session('tel'));
    	return	$this->fetch();
    }
   //增加学生开始
   public function add()
   {
// 	session_start();
//  $tel=$_SESSION['tel'];
//	if(!$tel){
// 		$this->error("请先登录系统!","index/sign");
//	}
    if(request()->isPost()){//如果没有提交表单就跳转到添加学生页面 
    	require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
		$studentData=array();
		$studentData['Num'] = clean_xss($_POST['Num']); //防注入代码   
		$studentData['Gr'] = clean_xss($_POST['Gr']); 
		$studentData['Cl'] = clean_xss($_POST['Cl']); 
		$studentData['Sid'] = clean_xss($_POST['Sid']);
		$studentData['Name'] = clean_xss($_POST['Name']);   
		$studentData['Sex'] = clean_xss($_POST['Sex']);
		$studentData['Level'] = clean_xss($_POST['Level']);
		$user=new StudentModer();
		if($user->addStudent($studentData)){
	 		die("恭喜您添加学生信息成功!<br/><a href='http://www.tp5.com/studentinformationmanagementsystem/student/index.html'>跳转到首页</a>
		<br/><a href='http://www.tp5.com/studentinformationmanagementsystem/student/add.html'>继续添加学生信息</a>");
	 	}else{
	   	$this->error("输入有误!请重新输入...","add");
	 	} 
    	return ;
    }	
    return	$this->fetch();
   }
   //增加学生结束
   
   //删除学生开始
   public function delete()
   {
// 	session_start();
//  $tel=$_SESSION['tel'];
//	if(!$tel){
// 		$this->error("请先登录系统!","index/sign");
//	}
    if(request()->isPost()){//如果没有提交表单就跳转到删除学生页面 
		require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
		//	安全防护开始
		$Sid = clean_xss($_POST['Sid']); //防注入代码   
		//	安全防护结束
		if(StudentModer::destroy($Sid)){
		die("恭喜您删除学生信息成功!<br/><a href='http://www.tp5.com/studentinformationmanagementsystem/student/index.html'>跳转到首页</a>
		<br/><a href='http://www.tp5.com/studentinformationmanagementsystem/student/delete.html'>继续删除学生信息</a>");
		}else{
	   		$this->error("该学生不存在!请重新输入...","delete");
		}
		return ;
	}
    return	$this->fetch();
  }
   //删除学生结束
   
    //修改学生开始
   public function modify()
   {
// 	session_start();
//  $tel=$_SESSION['tel'];
//	if(!$tel){
// 		$this->error("请先登录系统!","index/sign");
//	}
    if(request()->isPost()){//如果没有提交表单就跳转到删除学生页面 
    	require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
		//	安全防护开始
		$Num = clean_xss($_POST['Num']); //防注入代码   
		$Gr = clean_xss($_POST['Gr']); 
		$Cl = clean_xss($_POST['Cl']); 
		$Sid = clean_xss($_POST['Sid']);
		$Name = clean_xss($_POST['Name']);   
		$Sex = clean_xss($_POST['Sex']);
		$Level = clean_xss($_POST['Level']); 
		//	安全防护结束
		
		$user = new StudentModer(); 
	  	if($user->save(['num'=>$Num,'grade'=>$Gr,'className'=>$Cl,'sname'=>$Name,'sex'=>$Sex,'level'=>$Level],['sid'=>$Sid])){
			die ("恭喜您修改学生信息成功!<br/><a href='http://www.tp5.com/studentinformationmanagementsystem/student/index.html'>跳转到首页</a>
			<br/><a href='http://www.tp5.com/studentinformationmanagementsystem/student/modify.html'>继续修改学生信息</a>");
		}else{
	   		$this->error("输入有误!请重新输入...","modify");
		}
    	return ;
    }
	//根据网页的来源显示来显示不同的内容【在权限系统中换成了用隐藏的表单搞定了】
	$url = $_SERVER['HTTP_REFERER'];//获取上个页面的url
	if(!strcmp($url,'http://www.tp5.com/studentinformationmanagementsystem/student/search.html')){
		$this->assign('num',$_SESSION['num']);
		$this->assign('grade',$_SESSION['grade']);
		$this->assign('className',$_SESSION['className']);
		$this->assign('sid',$_SESSION['sid']);
		$this->assign('sname',$_SESSION['sname']);
		$this->assign('sex',$_SESSION['sex']);
		$this->assign('level',$_SESSION['level']);
	}else{
		$this->assign('num','');
		$this->assign('grade','');
		$this->assign('className','');
		$this->assign('sid','');
		$this->assign('sname','');
		$this->assign('sex','');
		$this->assign('level','');
	}
    return	$this->fetch();
   }
   //修改学生结束
   
   //查看学生开始
   public function search()
   {
// 	session_start();
//  $tel=$_SESSION['tel'];
//	if(!$tel){
// 		$this->error("请先登录系统!","index/sign");
//	}
    if(request()->isPost()){//如果没有提交表单就跳转到删除学生页面 
	  	require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
		//	安全防护开始
		$Sid = clean_xss($_POST['Sid']); //防注入代码   
		//	安全防护结束
//		$strSql="select num,de.departmentName,grade,sp.specialtyName,cl.className,sid,sname,sex,level from 
//		think_student as st,think_class as cl,think_specialty as sp, think_department as de
//		where sid='$Sid' and  st.classname=cl.className and cl.specialtyName=sp.specialtyName and sp.departmentName=de.departmentName;";//查询
		$strSql=Db::field('num,de.departmentName,grade,sp.specialtyName,cl.className,sid,sname,sex,level')
		->table(['think_student'=>'st','think_class'=>'cl','think_specialty'=>'sp','think_department'=>'de'])
//		->where(array('sid'=>'17310320310','st.classname'=>'cl.className','cl.specialtyName'=>'sp.specialtyName','sp.departmentName'=>'de.departmentName'))
		->where("sid ='$Sid' and st.classname=cl.className and cl.specialtyName=sp.specialtyName and sp.departmentName=de.departmentName")
		->select();
	//	$strSql = "select num,de.departmentName,grade,sp.specialtyName,cl.className,sid,sname,sex,level from 
	//	think_student as st,think_class as cl,think_specialty as sp, think_department as de
	//	where sid='03310510112' and  st.classname=cl.className and cl.specialtyName=sp.specialtyName and sp.departmentName=de.departmentName;";
		//原生sql查询
//		$result = Db::query($strSql);
		if(!$strSql){
	   		$this->error("查询错误,请重新查询!","search");
		}
//		
		$arr=array();//接收结果的数组
		//将二维数组转化为一位数组保存传递到前端去
		foreach($strSql as $row) {
			$arr[]=$row['num'];
			$arr[]=$row['departmentName'];
			$arr[]=$row['grade'];
			$arr[]=$row['specialtyName'];	
			$arr[]=$row['className'];
			$arr[]=$row['sid'];
			$arr[]=$row['sname'];
			$arr[]=$row['sex'];
			$arr[]=$row['level'];
			//将学生信息存放到session中 以便进行修改
			$_SESSION['num']=$row['num'];
			$_SESSION['grade']=$row['grade'];
			$_SESSION['className']=$row['className'];
			$_SESSION['sid']=$row['sid'];
			$_SESSION['sname']=$row['sname'];
			$_SESSION['sex']=$row['sex'];
			$_SESSION['level']=$row['level'];
		}
		echo json_encode($arr,JSON_UNESCAPED_UNICODE);//中文不转为unicode
	    return ;
	 }
    return	$this->fetch();
   }
   //查看学生结束
   
   //根据专业返回班级
   public function function_1_Class()
    {
		require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
		//	安全防护开始
		$data = clean_xss($_POST['data']); //防注入代码   
		//	安全防护结束
		$strSql="select className from 
		think_class as cl,think_specialty as sp
		where sp.specialtyName='$data' and cl.specialtyName=sp.specialtyName;";//查询
		//原生sql查询
		$result = Db::query($strSql);
		if(!$result){
	   		$this->error("查询错误,请重新查询!","search");
		}
		$arr=array();//接收结果的数组
		//将二维数组转化为一位数组保存传递到前端去
		foreach($result as $row) {
			$arr[]=$row['className'];	
		}
		echo json_encode($arr,JSON_UNESCAPED_UNICODE);//中文不转为unicode
    }
    //查找学生人数
   public function function_1()
    {
		require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
		//	安全防护开始
		$ZY = clean_xss($_POST['zy']); //防注入代码   
		$BJ = clean_xss($_POST['bj']); //防注入代码   
		//	安全防护结束
		if($BJ!='该项表示不对班级进行查询'&&$ZY!='该项表示不对专业进行查询'){
			$strSql="select count(sid) as num from think_student as st, think_class as cl where cl.specialtyName='$ZY' and cl.className='$BJ' 
			and st.classname=cl.className;";//查询
		}else if($BJ=='该项表示不对班级进行查询'&&$ZY!='该项表示不对专业进行查询'){
			$strSql="select count(sid) as num from think_student as st, think_class as cl where cl.specialtyName='$ZY'
			and st.classname=cl.className;";//查询
		//	$strSql="select count(sid) as num from student where specialty='$ZY'";//查询
		}else if($BJ=='该项表示不对班级进行查询'&&$ZY=='该项表示不对专业进行查询'){
			$strSql="select count(sid) as num from think_student";//查询
		}else{
			$pdo->destruct();
			die("查询错误");
		}
		//原生sql查询
		$result = Db::query($strSql);
		if(!$result){
	   		$this->error("查询错误,请重新查询!","index/index");
		}
		$arr=array();//接收结果的数组
		//将二维数组转化为一位数组保存传递到前端去
		foreach($result as $row) {
			$arr[]=$row['num'];	
		}
		echo json_encode($arr,JSON_UNESCAPED_UNICODE);//中文不转为unicode
    }
    
    //生成系部对应的专业
   public function function_2()
    {
		require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
		//	安全防护开始
		$XB = clean_xss(input('post.xb')); //防注入代码   
//		$XB = clean_xss($_POST['xb']); //防注入代码   
//		$XB = "计算机科学与技术系"; //防注入代码   
		//	安全防护结束
		$strSql="select specialtyName from think_specialty as sp ,think_department as de where de.departmentName='$XB' and sp.departmentName=de.departmentName;";//查询
		//原生sql查询
		$result = Db::query($strSql);
		if(!$result){
	   		$this->error("查询错误,请重新查询!","index/index");
		}
		$arr=array();//接收结果的数组
		//将二维数组转化为一位数组保存传递到前端去
		foreach($result as $row) {
			$arr[]=$row['specialtyName'];	
		}
		echo json_encode($arr,256);//中文不转为unicode
//		echo var_dump(json_encode($arr,256)); //中文不转为unicode
//  	$welcome=array();
//      $welcome['msgType']=3;
//		echo json_encode($welcome,256)."</br>";//中文不转为unicode
//		echo var_dump(json_encode($welcome,256)); //中文不转为unicode
    }
    
    //生成专业对应的班级
   public function function_3()
    {
		require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
		//	安全防护开始
		$XB = clean_xss($_POST['sc']); //防注入代码   
		//	安全防护结束
		$strSql="select className from think_class as cl,think_specialty as sp where sp.specialtyName ='$XB' and cl.specialtyName=sp.specialtyName";//查询
		//原生sql查询
		$result = Db::query($strSql);
		if(!$result){
	   		$this->error("查询错误,请重新查询!","index/index");
		}
		$arr=array();//接收结果的数组
		//将二维数组转化为一位数组保存传递到前端去
		foreach($result as $row) {
			$arr[]=$row['className'];	
		}
		echo json_encode($arr,JSON_UNESCAPED_UNICODE);//中文不转为unicode
    }
    
   public function test()
   {
   	    //首页还未写样式
   	    //通过分页显示数据
		//查询构造器  基于PDO实现
		$data = Db::field('className')
		    ->table(['think_class'=>'cl','think_specialty'=>'sp'])
		    ->where('sp.specialtyName ="计算机科学与技术" and cl.specialtyName=sp.specialtyName')//查询条件语句
//		    ->where(array('sp.specialtyName'=>'计算机科学与技术','cl.specialtyName'=>'sp.specialtyName'))
		    ->paginate(2);
//			->select();
//		dump($data);
//		die();
	    $page=$data->render();
	    $this->assign('data',$data);
	    $this->assign('page',$page);
   		return	$this->fetch();
   }
   
   public function hello()
   {
// 	session_start();
//  $tel=$_SESSION['tel'];
//	if(!$tel){
// 		$this->error("请先登录系统!","index/sign");
//	}
	  	require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
		//	安全防护开始
		$Sid = clean_xss($_POST['Sid']); //防注入代码   
		echo($Sid);
		//	安全防护结束
//		$strSql="select num,de.departmentName,grade,sp.specialtyName,cl.className,sid,sname,sex,level from 
//		think_student as st,think_class as cl,think_specialty as sp, think_department as de
//		where sid='$Sid' and  st.classname=cl.className and cl.specialtyName=sp.specialtyName and sp.departmentName=de.departmentName;";//查询
		$strSql=Db::field('num,de.departmentName,grade,sp.specialtyName,cl.className,sid,sname,sex,level')
		->table(['think_student'=>'st','think_class'=>'cl','think_specialty'=>'sp','think_department'=>'de'])
//		->where(array('sid'=>'17310320310','st.classname'=>'cl.className','cl.specialtyName'=>'sp.specialtyName','sp.departmentName'=>'de.departmentName'))
		->where(" st.classname=cl.className and cl.specialtyName=sp.specialtyName and sp.departmentName=de.departmentName")
		->select();
	//	$strSql = "select num,de.departmentName,grade,sp.specialtyName,cl.className,sid,sname,sex,level from 
	//	think_student as st,think_class as cl,think_specialty as sp, think_department as de
	//	where sid='03310510112' and  st.classname=cl.className and cl.specialtyName=sp.specialtyName and sp.departmentName=de.departmentName;";
		//原生sql查询
//		$result = Db::query($strSql);
//		if(!$result){
//	   		$this->error("查询错误,请重新查询!","search");
//		}
//		dump($strSql);die;
		$arr=array();//接收结果的数组
		//将二维数组转化为一位数组保存传递到前端去
		foreach($strSql as $row) {
			$arr[]=$row['num'];
			$arr[]=$row['departmentName'];
			$arr[]=$row['grade'];
			$arr[]=$row['specialtyName'];	
			$arr[]=$row['className'];
			$arr[]=$row['sid'];
			$arr[]=$row['sname'];
			$arr[]=$row['sex'];
			$arr[]=$row['level'];
			//将学生信息存放到session中 以便进行修改
			$_SESSION['num']=$row['num'];
			$_SESSION['grade']=$row['grade'];
			$_SESSION['className']=$row['className'];
			$_SESSION['sid']=$row['sid'];
			$_SESSION['sname']=$row['sname'];
			$_SESSION['sex']=$row['sex'];
			$_SESSION['level']=$row['level'];
		}
		dump($arr);die;
		echo json_encode($arr,JSON_UNESCAPED_UNICODE);//中文不转为unicode
   }
   public function hello1()
   {
   	// 	session_start();
//  $tel=$_SESSION['tel'];
//	if(!$tel){
// 		$this->error("请先登录系统!","index/sign");
//	}
    if(request()->isPost()){//如果没有提交表单就跳转到删除学生页面 
	  	require '/StudentInformationManagementSystem/denfence.php';//引入安全保护类
		//	安全防护开始
		$Sid = clean_xss($_POST['Sid']); //防注入代码   
		//	安全防护结束
//		$strSql="select num,de.departmentName,grade,sp.specialtyName,cl.className,sid,sname,sex,level from 
//		think_student as st,think_class as cl,think_specialty as sp, think_department as de
//		where sid='$Sid' and  st.classname=cl.className and cl.specialtyName=sp.specialtyName and sp.departmentName=de.departmentName;";//查询
		$strSql=Db::field('num,de.departmentName,grade,sp.specialtyName,cl.className,sid,sname,sex,level')
		->table(['think_student'=>'st','think_class'=>'cl','think_specialty'=>'sp','think_department'=>'de'])
//		->where(array('sid'=>'17310320310','st.classname'=>'cl.className','cl.specialtyName'=>'sp.specialtyName','sp.departmentName'=>'de.departmentName'))
		->where(" st.classname=cl.className and cl.specialtyName=sp.specialtyName and sp.departmentName=de.departmentName")
		->select();
	//	$strSql = "select num,de.departmentName,grade,sp.specialtyName,cl.className,sid,sname,sex,level from 
	//	think_student as st,think_class as cl,think_specialty as sp, think_department as de
	//	where sid='03310510112' and  st.classname=cl.className and cl.specialtyName=sp.specialtyName and sp.departmentName=de.departmentName;";
		//原生sql查询
//		$result = Db::query($strSql);
		if(!$strSql){
	   		$this->error("查询错误,请重新查询!","search");
		}
//		
		$arr=array();//接收结果的数组
		//将二维数组转化为一位数组保存传递到前端去
		foreach($strSql as $row) {
			$arr[]=$row['num'];
			$arr[]=$row['departmentName'];
			$arr[]=$row['grade'];
			$arr[]=$row['specialtyName'];	
			$arr[]=$row['className'];
			$arr[]=$row['sid'];
			$arr[]=$row['sname'];
			$arr[]=$row['sex'];
			$arr[]=$row['level'];
			//将学生信息存放到session中 以便进行修改
			$_SESSION['num']=$row['num'];
			$_SESSION['grade']=$row['grade'];
			$_SESSION['className']=$row['className'];
			$_SESSION['sid']=$row['sid'];
			$_SESSION['sname']=$row['sname'];
			$_SESSION['sex']=$row['sex'];
			$_SESSION['level']=$row['level'];
		}
		echo json_encode($arr,JSON_UNESCAPED_UNICODE);//中文不转为unicode
	    return ;
	 }
    return	$this->fetch();
   }
}
?>