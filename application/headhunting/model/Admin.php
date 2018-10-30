<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/08 19:39
 * @File Name: Admin.php
 * @Description:
 */
namespace app\headhunting\model;

use think\Model;
use think\Db;
use think\facade\Session;

class Admin extends Model
{
    /**
     * 登录模型,验证登录账号是否正确
     * @param array['account', password]
     * @return
     */
    public function login($param) {
        $result = Db::name('admin')->where('account', $param['account'])->field('admin_id, account, password, name, gender')->find();
        if (empty($result)) {
            return ['error_code' => 1, 'message' => '账户不存在', 'data' => []];
        }
        else if ($result['password'] == $param['password']) {
            Session::set('admin_id', $result['admin_id']);
            Session::set('admin_name', $result['name']);
            return ['error_code' => 0, 'message' => '登录成功', 'data' => []];
        }
        else {
            return ['error_code' => 1, 'message' => '密码不正确', 'data' => []];
        }
    }

    /**
     * 登出模型,清除 admin_id 和 admin_name
     * @param
     * @return
     */
    public function logout() {
        Session::delete('admin_id');
        Session::delete('admin_name');
        if (Session::has('admin_id') || Session::has('admin_name')) {
            return ['error_code' => 1, 'message' => '退出失败', 'data' => []];
        }
        else {
            return ['error_code' => 0, 'message' => '退出成功', 'data' => []];
        }
    }

    public function index() {
        $name = Session::get('admin_name');
        return $name ? $name : '';
    }
}
