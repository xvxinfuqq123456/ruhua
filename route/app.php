<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('', function () {
    echo '如花系统'.VAE_VERSION.'(开源板)';
});

Route::group('', function () {
    Route::get('index', 'index.index/index');//测试接口
    Route::get('wxpay', 'common.Pay/WxPay');//微信支付
    Route::get('alipay', 'common.Pay/ZfbPay');//支付宝H5支付支付
    Route::get('GzhPay', 'common.Pay/GzhPay');//公众号支付
    Route::get('WxH5Pay', 'common.Pay/WxH5Pay');//微信H5支付
    Route::get('ZfbAppPay', 'common.Pay/ZfbAppPay');//支付宝app支付
});

Route::group('auth', function () {
    Route::get('get_xcx_token', 'auth.Xcx/getXcxToken');//测试接口
});