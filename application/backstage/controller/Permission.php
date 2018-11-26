<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/08 17:10
 * @File Name: Permission.php
 * @Description:
 */
namespace app\backstage\controller;

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
        if (Session::has('headhunter_id')) {
            return 0;
        }
        else {
            return 1;
        }
    }
}
