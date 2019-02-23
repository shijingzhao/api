<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/11/14 19:52
 * @File Name: Company.php
 * @Description:
 */
namespace app\backstage\controller;

use think\Controller;
use think\facade\Request;
use app\backstage\controller\Permission;
use app\backstage\model\Company as CompanyModel;
use app\backstage\validate\Company as CompanyValidate;

class Company extends Controller
{
    /**
     * 新建公司
     * @param
     * @return
     */
    public function newCompany() {
        // 是否登录,如果没有登录需要从新登录
        $result = Permission::is_login();
        if ($result) {
            return ['code' => 1, 'msg' => 'not login', 'data' => []];
        }
        // 接收参数
        $param = Request::param();
        // 参数验证
        $validate = new CompanyValidate();
        if (!$validate->scene('new')->check($param)) {
            return ['code' => 1, 'msg' => $validate->getError(), 'data' => []];
        }
        // 传入模型,创建新的公司
        $company_obj = new CompanyModel();
        $result = $company_obj->create_new_company($param);
        if ($result['code'] == 0) {
            return ['code' => 0, 'msg' => '公司创建成功', 'data' => []];
        }
        else {
            return ['code' => 1, 'msg' => $result['msg'], 'data' => []];
        }
    }

    /**
     * 修改公司
     * @param
     * @return
     */
    public function updateCompany() {
        // 是否登录,如果没有登录需要从新登录
        $result = Permission::is_login();
        if ($result) {
            return ['code' => 1, 'msg' => 'not login', 'data' => []];
        }
        // 接收参数
        $param = Request::param();
        // 参数验证
        $validate = new CompanyValidate();
        if (!$validate->scene('up')->check($param)) {
            return ['code' => 1, 'msg' => $validate->getError(), 'data' => []];
        }
        // 传入模型,修改公司
        $company_obj = new CompanyModel();
        $result = $company_obj->update_company($param);
        if ($result['code'] == 0) {
            return ['code' => 0, 'msg' => '更新成功', 'data' => []];
        }
        else {
            return ['code' => 1, 'msg' => $result['msg'], 'data' => []];
        }
    }

    /**
     * 公司列表
     * @param
     * @return
     */
    public function list() {
        // 是否登录,如果没有登录需要从新登录
        $result = Permission::is_login();
        if ($result) {
            return ['code' => 1, 'msg' => 'not login', 'data' => []];
        }
        // 进入模型,获取公司列表
        $company_obj = new CompanyModel();
        $result = $company_obj->get_company_list();
        if ($result['code'] == 0) {
            return ['code' => 0, 'msg' => '成功', 'data' => $result['data']];
        }
        else {
            return ['code' => 1, 'msg' => $result['msg'], 'data' => []];
        }
    }
}
