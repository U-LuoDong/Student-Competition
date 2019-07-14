<?php
namespace app\StudentInformationManagementSystem\validate;
use think\Validate;
class Manager extends Validate
{

    protected $rule=[
        'uPhone_Number'=>'unique:manager|require|max:25',
        'uPassword'=>'require|min:6',
    ];


    protected $message=[
        'uPhone_Number.require'=>'管理员账号不得为空！',
        'uPhone_Number.unique'=>'管理员账号不得重复！',
        'uPassword.require'=>'管理员密码不得为空！',
        'uPassword.min'=>'密码不得少于6位！',
    ];

    protected $scene=[
        'add'=>['uPhone_Number','uPassword'],
        'edit'=>['uPhone_Number','uPassword'=>'min:6'],//修改密码时候要么必须大于6位或者为空
    ];





    

    




   

	












}
