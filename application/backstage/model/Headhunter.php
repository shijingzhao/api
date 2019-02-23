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
        $result = Db::name('headhunter')->where('account', $param['account'])->field('headhunter_id, account, password, name, gender, permission')->find();
        if (empty($result)) {
            return ['code' => 1, 'msg' => '账户不存在', 'data' => []];
        }
        else if (password_verify($param['password'], $result['password'])) {
            Session::set('headhunter_id', $result['headhunter_id']);
            Session::set('name', $result['name']);
            Session::set('permission', $result['permission']);
            unset($result['headhunter_id'], $result['account'], $result['password']);
            return ['code' => 0, 'msg' => '登录成功', 'data' => $result];
        }
        else {
            return ['code' => 1, 'msg' => '密码不正确', 'data' => []];
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
            return ['code' => 1, 'msg' => '退出失败', 'data' => []];
        }
        else {
            return ['code' => 0, 'msg' => '退出成功', 'data' => []];
        }
    }

    public function index() {
        $name = Session::get('name');
        return $name ? $name : '';
    }

    /**
     * 猎头列表
     * @param
     * @return
     */
    public function get_user_list() {
        try {
            $result = Db::name('headhunter')
                ->field(
                    'name,
                     account,
                     gender,
                     permission'
                    )
                ->selectOrFail();
            $total = Db::name('headhunter')->selectOrFail();
            $total = count($total);
        }
        catch (\Exception $e) {
            return ['code' => 1, 'msg' => '没有查询到猎头', 'data' => []];
        }
        return ['code' => 0, 'count' => $total, 'msg' => '查找成功', 'data' => $result];
    }
}
