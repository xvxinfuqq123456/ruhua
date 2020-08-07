<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/8/4 0004
 * Time: 16:42
 */

namespace GzhPay;

use app\service\TokenService;
use GzhPay\lib\WxPayApi;
use GzhPay\lib\WxPayUnifiedOrder;
use think\Exception;
use think\facade\Log;
use GzhPay\lib\WxPayDataBase;
use ruhua\exceptions\BaseException;

class JsApi
{
    public static function gzh_pay($order_data)
    {
        $jsApiParameters = "";

        $openid=TokenService::getCurrentTokenVar('openid');
        $gzh_back=config('setting.gzh_back');
        $web_name=config('setting.web_name');

        try {
            $tools = new JsApiPay();
            new WxPayDataBase();

            $input = new WxPayUnifiedOrder();
            $input->SetBody($web_name);
            $input->SetAttach("test");
            $input->SetOut_trade_no($order_data['order_num']);
            $input->SetTotal_fee($order_data['order_money'] * 100);
            $input->SetTime_start(date("YmdHis"));
            //$input->SetTime_expire(date("YmdHis", time() + 600));
            $input->SetGoods_tag("test");
            $input->SetNotify_url($gzh_back);
            $input->SetTrade_type("JSAPI");
            $input->SetOpenid($openid);
            $config = new WxPayConfig();
            $order = WxPayApi::unifiedOrder($config, $input);
            $jsApiParameters = $tools->GetJsApiParameters($order);

        } catch (Exception $e) {
            throw new BaseException(['msg' => '支付错误']);
        }
        return $jsApiParameters;
    }


}