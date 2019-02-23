<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/12/25 10:16
 * @File Name: Talent.php
 * @Description:
 */
namespace app\backstage\controller;

use think\Controller;
use think\facade\Request;
use app\backstage\controller\Permission;
use app\backstage\model\Talent as TalentModel;
use app\backstage\validate\Talent as TalentValidate;

class Talent extends Controller
{
    /**
     * 新建人才库
     * @param
     * @return
     */
    public function newTalent() {
        // 是否登录,如果没有登录需要从新登录
        $is_login = Permission::is_login();
        if ($is_login) {
            return ['code' => 1, 'msg' => 'not login', 'data' => []];
        }
        // 接收参数
        $param = Request::param();
        // 接收参数
        $validate = new TalentValidate();
        if (!$validate->scene('new')->check($param)) {
            return ['code' => 1, 'msg' => $validate->getError(), 'data' => []];
        }
        // 传入模型
        $talent_obj = new TalentModel();
        $result = $talent_obj->create_new_talent($param);
        if ($result['code'] == 0) {
            return ['code' => 0, 'msg' => '人才创建成功', 'data' => []];
        }
        else {
            return ['code' => 1, 'msg' => $result['msg'], 'data' => []];
        }
    }

    /**
     * 人才库列表
     * @param
     * @return
     */
    public function list() {
        // 是否登录,如果没有登录需要从新登录
        $is_login = Permission::is_login();
        if ($is_login) {
            return ['code' => 1, 'msg' => 'not login', 'data' => []];
        }
        // 进入模型
        $talent_obj = new TalentModel();
        $result = $talent_obj->talent_list();
        if ($result['code'] == 0) {
            return ['code' => 0, 'count' => $result['count'], 'msg' => '查询成功', 'data' => $result['data']];
        }
        else {
            return ['code' => 1, 'msg' => $result['msg'], 'data' => []];
        }
    }
}
