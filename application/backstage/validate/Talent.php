<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/12/25 10:42
 * @File Name: Talent.php
 * @Description:
 */
namespace app\backstage\validate;

use think\Validate;

class Talent extends Validate
{
    // 验证规则
    protected $rule = [
        'talent_id' => 'require',
        'name'      => 'require',
        'gender'    => 'require',
        'phone'     => 'require',
        'mailbox'   => 'require',
        'address'   => 'require',
        'dream_position'    => 'require',
        'expected_salary'   => 'require',
        'expected_city'     => 'require',
        'education'         => 'require',
        'working_years'     => 'require',
        'work_experience'   => 'require',
        'project_experience'=> 'require',
        'skill_list'=> 'require',
        'headhunter_id'     => 'require',
        'type'      => 'require',
        'status'    => 'require',
        'created'   => 'require',
        'updated'   => 'require',
        'deleted'   => 'require',
    ];

    // 验证场景
    protected $scene = [
        'new'   => [
            'name',
            'gender',
            'phone',
            'mailbox',
            'address',
            'dream_position',
            'expected_salary',
            'expected_city',
            'education',
            'working_years',
            'work_experience',
            'project_experience',
            'skill_list',
        ],
    ];
}
