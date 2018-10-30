<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/08 17:10
 * @File Name: Permission.php
 * @Description:
 */
namespace app\headhunting\controller;

use think\Controller;
use think\facade\Session;

class Permission extends Controller
{
    /**
     * 是否已经登录,已登录->阻止再次登录
     * @param
     * @return
     */
    public static function is_login() {
        if (Session::has('admin_id')) {
            return ['error_code' => 0, 'message' => 'is login', 'data' => []];
        }
        else {
            return ['error_code' => 1, 'message' => 'not login', 'data' => []];
        }
    }
}
