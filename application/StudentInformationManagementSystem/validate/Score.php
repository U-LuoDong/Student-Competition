<?php
namespace app\StudentInformationManagementSystem\validate;
use think\Validate;

class Score extends Validate
{
	protected $rule=[
		'name|用户名'=>'require',
		'math|数学'=>'require',
		'English|英语'=>'require',
	];
	
	protected $message=[
		'name.require'=>'姓名不能为空',
		'math.require'=>'数学成绩不能为空',
		'English.require'=>'英语成绩不能为空',
	];
//	protected $rule = [
//      ['name','require|length:11|/^1[34578]\d{9}$/','手机号码必填|手机号码必须为11位，请检查。|您输入的手机号码有问题，请检查。'],
//  ];

}

?>