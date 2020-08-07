<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/8/6 0006
 * Time: 13:02
 */
namespace app\controller\auth;

use app\service\TokenService;
use ruhua\bases\BaseCommon;
use ruhua\bases\BaseController;
use ruhua\exceptions\TokenException;
use think\facade\Log;

class Xcx extends BaseController
{


    /**获取用户openID
     * 保存到缓存并返回前端token
     * @param $code
     */
    public function getXcxToken($code)
    {
        $appid = config('setting.wx_app_id');
        $secret = config('setting.wx_app_secret');

        if (!$appid || !$secret) {
            throw new TokenException(['msg' => '未配置数据']);
        }
        //sprintf函数是把百分号（%）符号替换成一个作为参数进行传递的变量：%s=字符串,%u=正整数
        $login_url = 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code';
        $wxLoginUrl = sprintf($login_url, $appid, $secret, $code);
        $result = (new BaseCommon())->curl_get($wxLoginUrl);
        $wxResult = json_decode($result, true);
        Log::error('appid');
        Log::error($wxResult);
        Log::error('appid');

        if(empty($wxResult)){
           throw new TokenException(['msg'=>'获取信息失败']);
        }
        else{
            $token=(new TokenService())->saveCache($wxResult);
        }
        $data=['token'=>$token];
        return app('json')->go($data);

    }

}