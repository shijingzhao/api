<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/10/08 19:39
 * @File Name: Headhunter.php
 * @Description:
 */
namespace app\backstage\model;

use think\Model;
use think\Db;
use think\facade\Session;

class Headhunter extends Model
{
    /**
     * 登录模型,验证登录账号是否正确
     * @param array['account', password]
     * @return
     */
    public function login($param) {
        $result = Db::name('headhunter')->where('account', $param['account'])->field('headhunter_id, account, password, name, gender')->find();
        if (empty($result)) {
            return ['code' => 1, 'message' => '账户不存在', 'data' => []];
        }
        else if ($result['password'] == $param['password']) {
            Session::set('headhunter_id', $result['headhunter_id']);
            Session::set('headhunter_name', $result['name']);
            return ['code' => 0, 'message' => '登录成功', 'data' => []];
        }
        else {
            return ['code' => 1, 'message' => '密码不正确', 'data' => []];
        }
    }

    /**
     * 登出模型,清除 headhunter_id 和 headhunter_name
     * @param
     * @return
     */
    public function logout() {
        Session::delete('headhunter_id');
        Session::delete('headhunter_name');
        if (Session::has('headhunter_id') || Session::has('headhunter_name')) {
            return ['code' => 1, 'message' => '退出失败', 'data' => []];
        }
        else {
            return ['code' => 0, 'message' => '退出成功', 'data' => []];
        }
    }

    public function index() {
        $name = Session::get('headhunter_name');
        return $name ? $name : '';
    }
}
