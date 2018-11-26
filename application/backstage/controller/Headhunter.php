<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/08 19:17
 * @File Name: Headhunter.php
 * @Description:
 */
namespace app\backstage\controller;

use think\Controller;
use think\facade\Request;
use app\backstage\controller\Permission;
use app\backstage\model\Headhunter as HeadhunterModel;
use app\backstage\validate\Headhunter as HeadhunterValidate;

class Headhunter extends Controller
{
    /**
     * 登录
     * @param array['account', 'password']
     * @return 
     */
    public function login() {
        // 是否登录,如果登录->不需要重复登录
        $result = Permission::is_login();
        if (!$result) {
            return ['code' => 0, 'message' => 'is login', 'data' => []];
        }
        // 接受参数
        $param = Request::param();
        // 参数验证
        $validate = new HeadhunterValidate();
        if (!$validate->scene('login')->check($param)) {
            return ['code' => 1, 'message' => $validate->getError(), 'data' => []];
        }
        // 传入模型,验证账号和密码是否正确
        $admin_obj = new HeadhunterModel();
        $result = $admin_obj->login($param);
        if ($result['code'] == 0) {
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
        $admin_obj = new HeadhunterModel();
        $result = $admin_obj->logout();
        return $result;
    }

    public function index() {
        $admin_obj = new HeadhunterModel();
        $result = $admin_obj->index();
        return ['code' => 0, 'message' => $result, 'data' => []];
    }

    public function test() {
    }
}
