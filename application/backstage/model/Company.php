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
    /**
     * 创建公司
     * @param
     * @return
     */
    public function create_new_company($param) {
        try {
            // 插入数据库
            $param['headhunter_id'] = Session::get('headhunter_id');
            $result = Db::name('company')->insert($param);
        }
        catch (\Exception $e) {
            // echo $e->getMessage(); //SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'JZ201809' for key 'number'
            if (strpos($e->getMessage(), 'Integrity constraint violation')) {
                return ['code' => 1, 'msg' => '项目编号已存在,请您换一个编号', 'data' => []];
            }
            return ['code' => 1, 'msg' => '数据字段不存在', 'data' => []];
        }
        return ['code' => 0, 'msg' => '数据创建成功', 'data' => []];
    }

    /**
     * 更新公司信息
     * @param
     * @return
     */
    public function update_company($param) {
        try {
            // 更新信息
            $result = Db::name('company')->update($param);
        }
        catch (\Exception $e) {
            // echo $e->getMessage();
            // SQLSTATE[42S22]: Column not found: 1054 Unknown column 'id' in 'where clause'
            // SQLSTATE[22001]: String data, right truncated: 1406 Data too long for column 'com_contact' at row 1
            if (strpos($e->getMessage(), 'Column not found')) {
                return ['code' => 1, 'msg' => '更新键不存在', 'data' => []];
            }
            elseif (strpos($e->getMessage(), 'String data')) {
                return ['code' => 1, 'msg' => '字段长度超出限制', 'data' => []];
            }
            return ['code' => 1, 'msg' => '未知错误', 'data' => []];
        }
        return ['code' => 0, 'msg' => '更新成功', 'data' => []];
    }

    /**
     * 公司列表
     * @param
     * @return
     */
    public function get_company_list() {
        try {
            // 查询数据库
            $result = Db::name('company')
                ->field(
                    'com_name,
                     com_contact,
                     com_tel,
                     nature,
                     introduction'
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
