<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/08 19:17
 * @File Name: Admin.php
 * @Description:
 */
namespace app\headhunting\controller;

use think\Controller;
use think\facade\Request;
use app\headhunting\controller\Permission;
use app\headhunting\model\Admin as AdminModel;
use app\headhunting\validate\Admin as AdminValidate;

class Admin extends Controller
{
    /**
     * 登录
     * @param array['account', 'password']
     * @return 
     */
    public function login() {
        // 是否登录,如果登录->不需要重复登录
        $result = Permission::is_login();
        if ($result['error_code'] == 0) {
            return $result;
        }
        // 接受参数
        $param = Request::param();
        // 参数验证
        $validate = new AdminValidate();
        if (!$validate->scene('login')->check($param)) {
            return ['error_code' => 1, 'message' => $validate->getError(), 'data' => []];
        }
        // 传入模型,验证账号和密码是否正确
        $admin_obj = new AdminModel();
        $result = $admin_obj->login($param);
        if ($result['error_code'] == 0) {
            return $result;
        }
        else {
            return $result;
        }
    }

    /**
     * 登出
     * @param
     * @return
     */
    public function logout() {
        $admin_obj = new AdminModel();
        $result = $admin_obj->logout();
        return $result;
    }

    public function index() {
        $admin_obj = new AdminModel();
        $result = $admin_obj->index();
        return ['error_code' => 0, 'message' => $result, 'data' => []];
    }

    public function test() {
    }
}
