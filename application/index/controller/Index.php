<?php
namespace app\index\controller;

use app\index\controller\Permissions;

class Index
{
    public function index()
    {
    	$data = ['fir' => ['fir' => 'fir', 'sec' => 'sec', 'thr' => 'thr'], 'sec' => ['fir' => 'fir', 'sec' => 'sec', 'thr' => 'thr'], 'thr' => ['fir' => 'fir', 'sec' => 'sec', 'thr' => 'thr']];
        return ['error_code' => 0, 'message' => 'success', 'data' => $data];
    }
}
