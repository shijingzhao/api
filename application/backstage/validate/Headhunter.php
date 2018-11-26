<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/09 19:34
 * @File Name: Headhunter.php
 * @Description:
 */
namespace app\backstage\validate;

use think\Validate;

class Headhunter extends Validate
{
	// 验证规则
    protected $rule = [
        'account' => 'require|length:11',
        'password' => 'require|max:20'
    ];

    // 验证场景
    protected $scene = [
        'login'  =>  ['account', 'password'],
    ];
}