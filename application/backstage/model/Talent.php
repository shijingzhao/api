<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/12/25 10:29
 * @File Name: Talent.php
 * @Description:
 */
namespace app\backstage\model;

use think\Db;
use think\Model;
use think\facade\Session;

class Talent
{
    /**
     * 创建人才
     * @param
     * @return
     */
    public function create_new_talent($param) {
        try {
            // 插入数据库
            $param['headhunter_id'] = Session::get('headhunter_id');
            $result = Db::name('talent')->insert($param);
        }
        catch (\Exception $e) {
            return ['code' => 1, 'msg' => '字段类型不正确', 'data' => []];
        }
        return ['code' => 0, 'msg' => '数据创建成功', 'data' => []];
    }

    /**
     * 人才库列表
     * @param
     * @return
     */
    public function talent_list() {
        try {
            // 查询数据库
            $result = Db::name('talent')
                ->field(
                    'name,
                     gender,
                     phone,
                     mailbox,
                     address,
                     dream_position,
                     expected_salary,
                     expected_city,
                     education,
                     working_years,
                     work_experience,
                     project_experience,
                     skill_list'
                    )
                ->selectOrFail();
            $total = Db::name('talent')->selectOrFail();
            $total = count($total);
        }
        catch (\Exception $e) {
            // echo $e;
            return ['code' => 1, 'msg' => $e->getMessage(), 'data' => []];
        }
        return ['code' => 0, 'count' => $total, 'msg' => '查询成功', 'data' => $result];
    }
}
