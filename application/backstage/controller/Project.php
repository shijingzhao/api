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
        // 是否登录,如果登录->不需要重复登录
        $result = Permission::is_login();
        if ($result['error_code'] != 0) {
            return $result;
        }
        // 接受参数
        $param = Request::param();
        // 参数验证
        $validate = new ProjectValidate();
        if (!$validate->scene('new')->check($param)) {
            return ['error_code' => 1, 'message' => $validate->getError(), 'data' => []];
        }
        // 传入模型,创建新的项目
        $project_obj = new ProjectModel();
        $result = $project_obj->create_new_Project($param);
        if ($result['error_code'] == 0) {
            return ['error_code' => 0, 'message' => '项目创建成功', 'data' => []];
        }
        else {
            return ['error_code' => 1, 'message' => '项目创建失败', 'data' => []];
        }
    }
}
