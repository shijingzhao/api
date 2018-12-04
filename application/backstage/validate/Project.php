<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/11 10:54
 * @File Name: Project.php
 * @Description:
 */
namespace app\backstage\validate;

use think\Validate;

class Project extends Validate
{
	// 验证规则
    protected $rule = [
        'project_id'            => 'require',
    	'number'                => 'require',
        'name'                  => 'require|max:20',
        'start_date'            => 'require|dateFormat:Y-m-d',
        'plan_date'             => 'require|dateFormat:Y-m-d',
        'project_status'        => 'require',
        'priority'              => 'require',
        'client_name'           => 'require',
        'collection_status'     => 'require',
        'client_manager'        => 'require',
        'business_people'       => 'require',
        'project_director'      => 'require',
        'project_consultant'    => 'require',
        'customer_contact'      => 'require',
        'customer_payer'        => 'require',
        'seeker'                => 'require',
        'job_description'       => 'require',
        'industry'              => 'require',
        'function'              => 'require',
        'work_place'            => 'require',
        'recruits_number'       => 'require',
        'language'              => 'require',
        'education'             => 'require',
        'com_id'                => 'require',
    ];

    // 验证场景
    protected $scene = [
        'new'  =>  [
            'number',
            'name',
            'start_date',
            'plan_date',
            'project_status',
            'priority',
            'client_name',
            'collection_status',
            'client_manager',
            'business_people',
            'project_director',
            'project_consultant',
            'customer_contact',
            'customer_payer',
            'seeker',
            'job_description',
            'industry',
            'function',
            'work_place',
            'recruits_number',
            'language',
            'education',
            'com_id',
        ],
        'get'   =>  [
            'project_id'
        ]
    ];
}