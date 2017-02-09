<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Http\Controllers\Controller;

class WebPayController extends Controller
{
    //支付处理
    public function aliPay(){

        $gateway = Omnipay::getSupportedGateways();
//        $gateway = Omnipay::gateway();

        $options = [
            'out_trade_no' => date('YmdHis') . mt_rand(1000,9999),
            'subject' => 'Alipay Test',
            'total_fee' => '1.23',
        ];

        $response = $gateway->purchase($options)->send();
        $response->redirect();
    }

    //跳转页面
    public function aliPayResult(){

        $gateway = Omnipay::gateway();

        $options = [
            'request_params'=> $_REQUEST,
        ];

        $response = $gateway->completePurchase($options)->send();

        if ($response->isSuccessful() && $response->isTradeStatusOk()) {
            //支付成功后操作
            exit('支付成功');
        } else {
            //支付失败通知.
            exit('支付失败');
        }

    }


    //微信支付
    public function wechatPay()
    {

    }
}
