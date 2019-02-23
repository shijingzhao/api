<?php
/**
 * @Author: jingzhao
 * @Created Time : 2018/12/25 18:02
 * @File Name: Permission.php
 * @Description:
 */
namespace app\index\controller;

use think\Controller;
use think\facade\Session;

class Permission extends Controller
{
    public function initialize() {
        echo "initialize";
    }

    public function index() {
        echo 'Permission';
    }
}
