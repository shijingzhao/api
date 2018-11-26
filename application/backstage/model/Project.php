<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/11 11:35
 * @File Name: Project.php
 * @Description:
 */
namespace app\backstage\model;

use think\Db;
use think\Model;
use think\facade\Session;

class Project extends Model
{
    /**
     * 创建新的项目
     * @param
     * @return
     */
    public function create_new_project($param) {
        try {
            // 插入数据库
            $param['headhunter_id'] = Session::get('headhunter_id');
            $result = Db::name('project')->insert($param);
        }
        catch (\Exception $e) {
            // echo $e->getMessage(); // SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'JZ201809' for key 'number'
            if (strpos($e->getMessage(), 'Integrity constraint violation')) {
                return ['code' => 1, 'message' => '项目编号已存在,请您换一个编号', 'data' => []];
            }
            return ['code' => 1, 'message' => '数据字段不存在', 'data' => []];
        }
        return ['code' => 0, 'message' => '数据创建成功', 'data' => []];
    }

    /**
     * 查找项目
     * @param
     * @return
     */
    public function get_project($param) {
        try {
            // 查找数据库
            $result = Db::name('project')
                ->where('project_id', $param['project_id'])
                ->field(
                    'number,
                     name,
                     start_date,
                     plan_date,
                     project_status,
                     priority,
                     client_name,
                     collection_status,
                     client_manager,
                     business_people,
                     project_director,
                     project_consultant,
                     customer_contact,
                     customer_payer,
                     seeker,
                     company_profile,
                     job_description,
                     industry,
                     function,
                     work_place,
                     recruits_number,
                     language,
                     education'
                    )
                ->findOrFail();
        }
        catch (\Exception $e) {
            // 异常捕获
            // echo $e->getMessage();  table data not Found:db_project
            return ['code' => 1, 'message' => '没有查到此条数据', 'data' => []];
        }
        return ['code' => 0, 'message' => '数据查找成功', 'data' => $result];
    }

    /**
     * 我的项目
     * @param
     * @return
     */
    public function my_project() {
        try {
            $result = Db::name('project')
                ->where('backstage_id', Session::get('headhunter_id'))
                ->field(
                    'number,
                     name,
                     start_date,
                     plan_date,
                     project_status,
                     priority,
                     client_name,
                     collection_status'
                    )
                ->selectOrFail();
        }
        catch (\Exception $e) {
            // 异常捕获
            // echo $e->getMessage();  table data not Found:db_project
            return ['code' => 1, 'message' => '没有查到此条数据', 'data' => []];
        }
        return ['code' => 0, 'message' => '数据查找成功', 'data' => $result];
    }
}
