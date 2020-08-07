<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/8/6 0006
 * Time: 14:46
 */
namespace app\controller\common;
use app\service\AliPayService;
use app\service\PayService;
use GzhPay\JsApi;
use ruhua\bases\BaseController;
use think\facade\Log;

class Pay extends BaseController
{
    /**
     * 微信支付
     * 只需要参数总价与编号
     * 如果需要设置自己的信息，可以在makeWxPreOrder中修改
     */
    public function WxPay($data='')
    {

        //数据示例
        $data=[
            'total'=>1,
            'order_num'=>'C15815646546541561'
        ];
        $res=(new PayService())->makeWxPreOrder($data);
        return app('json')->go($res);
    }


    /**公众号支付
     * @param string $data
     * @return mixed
     */
    public function GzhPay($data='')
    {
        $data=[
            'order_num'=>'C141215121512',
            'order_money'=>2,
        ];
        $res=(new JsApi())->gzh_pay($data);
        $res=json_decode($res,true);
        return app('json')->go($res);
    }

    /**微信H5支付
     * @param string $data
     */
    public function WxH5Pay($data='')
    {
        $data=[
            'order_num'=>'C1412151215N2',
            'order_money'=>1.00
        ];
        $res=(new PayService())->wx_h5_pay($data);
        Log::error($res);
        return app('json')->success($res);
    }

    /**支付宝H5支付
     * @return string|\提交表单HTML文本
     */
    public function ZfbPay($data='')
    {
        $data=[
            'order_money'=>1,
            'order_num'=>'C15815646546541561'
        ];
        $res=(new AliPayService())->pay($data);
        return $res;
    }

    public function ZfbAppPay($data='')
    {
        $data=[
            'order_money'=>1,
            'order_num'=>'C15815646546541561'
        ];
        $res=(new AliPayService())->appPay($data);
        $res=['data'=>$res];
        return app('json')->go($res);
    }




    /**
     * 支付回调
     */
    public function PayBack()
    {
        //.....
    }

}