<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/11/17 18:53
 * @File Name: Company.php
 * @Description:
 */
namespace app\backstage\model;

use think\Db;
use think\Model;
use think\facade\Session;

class Company
{
    public function create_new_Company($param) {
        try {
            // 插入数据库
            $param['headhunter_id'] = Session::get('admin_id');
            $result = Db::name('company')->insert($param);
        }
        catch (\Exception $e) {
            // echo $e->getMessage(); //SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'JZ201809' for key 'number'
            if (strpos($e->getMessage(), 'Integrity constraint violation')) {
                return ['code' => 1, 'message' => '项目编号已存在,请您换一个编号', 'data' => []];
            }
            return ['code' => 1, 'message' => '数据字段不存在', 'data' => []];
        }
        return ['code' => 0, 'message' => '数据创建成功', 'data' => []];
    }
}
