<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/11/14 20:14
 * @File Name: Company.php
 * @Description:
 */
namespace app\backstage\validate;

use think\Validate;

class Company extends Validate
{
    // 验证规则
    protected $rule = [
        'com_id'        => 'require',
        'com_name'      => 'require',
        'com_contact'   => 'require',
        'com_tel'       => 'require',
        'nature'        => 'require',
        'introduction'  => 'require',
        'headhunter_id' => 'require',
        'type'          => 'require',
        'status'        => 'require',
        'created'       => 'require',
        'updated'       => 'require',
        'deleted'       => 'require'
    ];

    // 验证场景
    protected $scene = [
        'new'   => [
            'com_name',
            'com_contact',
            'com_tel',
            'nature',
            'introduction',
        ],
        'up'    => [
            'com_id',
        ]
    ];
}
