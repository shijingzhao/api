<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/11 11:35
 * @File Name: Project.php
 * @Description:
 */
namespace app\backstage\model;

use think\Model;
use think\Db;
use think\facade\Session;

class Project extends Model
{
    /**
     * 创建新的项目
     * @param
     * @return
     */
    public function create_new_project($param) {
        // 插入数据库
        $result = Db::name('project')->insert($param);
        if ($result) {
            return ['error_code' => 0, 'message' => '数据创建成功', 'data' => []];
        }
        else {
            return ['error_code' => 1, 'message' => '数据创建失败', 'data' => []];
        }
    }

    /**
     * 查找项目
     * @param
     * @return
     */
    public function get_project() {

    }
}
