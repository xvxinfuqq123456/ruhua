<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/7/24 0024
 * Time: 10:44
 */
namespace app\controller\index;


use ruhua\bases\BaseController;




class index extends BaseController
{
    public function index()
    {
        $data=['msg'=>'欢迎使用如花系统开源版'];
        return app('json')->go($data);
    }

}