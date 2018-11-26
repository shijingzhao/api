<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/11 10:33
 * @File Name: Project.php
 * @Description:
 */
namespace app\backstage\controller;

use think\Controller;
use think\facade\Request;
use app\backstage\controller\Permission;
use app\backstage\model\Project as ProjectModel;
use app\backstage\validate\Project as ProjectValidate;

class Project extends Controller
{
    /**
     * 新建项目
     * @param
     * @return
     */
    public function newProject() {
        // 是否登录,如果没有登录需要从新登录
        $result = Permission::is_login();
        if ($result) {
            return ['code' => 1, 'message' => 'not login', 'data' => []];
        }
        // 接受参数
        $param = Request::param();
        // 参数验证
        $validate = new ProjectValidate();
        if (!$validate->scene('new')->check($param)) {
            return ['code' => 1, 'message' => $validate->getError(), 'data' => []];
        }
        // 传入模型,创建新的项目
        $project_obj = new ProjectModel();
        $result = $project_obj->create_new_Project($param);
        if ($result['code'] == 0) {
            return ['code' => 0, 'message' => '项目创建成功', 'data' => []];
        }
        else {
            return ['code' => 1, 'message' => $result['message'], 'data' => []];
        }
    }

    /**
     * 查找项目
     * @param
     * @return
     */
    public function getProject() {
        // 是否登录,如果没有登录需要从新登录
        $result = Permission::is_login();
        if ($result) {
            return ['code' => 1, 'message' => 'not login', 'data' => []];
        }
        // 接收参数
        $param = Request::param();
        // 参数验证
        $validate = new ProjectValidate();
        if (!$validate->scene('get')->check($param)) {
            return ['code' => 1, 'message' => $validate->getError(), 'data' => []];
        }
        // 传入模型,查找项目
        $project_obj = new ProjectModel();
        $result = $project_obj->get_project($param);
        if ($result['code'] == 0) {
            return ['code' => 0, 'message' => '项目查找成功', 'data' => $result['data']];
        }
        else {
            return ['code' => 1, 'message' => $result['message'], 'data' => []];
        }
    }

    /**
     * 我的项目
     * @param
     * @return
     */
    public function myProject() {
        // 是否登录,如果没有登录需要从新登录
        $result = Permission::is_login();
        if ($result) {
            return ['code' => 1, 'message' => 'not login', 'data' => []];
        }
        // 传入模型,查找项目
        $project_obj = new ProjectModel();
        $result = $project_obj->my_project();
        if ($result['code'] == 0) {
            return ['code' => 0, 'message' => '项目查找成功', 'data' => $result['data']];
        }
        else {
            return ['code' => 1, 'message' => $result['message'], 'data' => []];
        }
    }
}
