<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Http\Controllers\Controller;

class WebPayController extends Controller
{
    //支付处理
    public function aliPay(){

        $gateway = Omnipay::create('Alipay_AopApp');
        $gateway->setAppId('2017020805574567');
        $gateway->setPrivateKey('MIIEpAIBAAKCAQEAx0vsaXPhCGZ5k4+OK1H2WAjuDrGFC6v5TeuOOXCJi2wuHaxRc3afSBYMO+ViS1ki+4YCkdOsfA+XQ/btm3/KY/eugCbCGARZRW78sgXVPtaESZxxflg8HxvLOqx2Vj1GlZk08RmmJIiovg0hGd4b4+sj90ycg3aefxgV7lSeuwOXple/3Vb5VRcOHyK1/ca1DDPEvakKGF+DZgFwDXi9YKhzpDSjW2pJsXC77SguLAvWQWuyFUZ8C3V+ltpszpaxZdtHTFIgV+1+71ybjm+e/tzkph00wp33iV1R4KHADLSVYlESC5lLvdMruewHLm/vAnZFYBSjr5iApRnkjMsFaQIDAQABAoIBAEz3l1/Kbtftq3o/cKpuRvMMz9NA3574VZmwJQct3RDJQK4ZBIPRBgay7Rqcpe9vh0EYKhnjY7Ot2b9Xt7/cBG/DEdNQJJld5JQaHuEpu4c/FWvQTUx8CwwAkeYhALqhg4b22ilavH1TgceUDnqM+rx07Tjuj2t9/gwbYyzd5UdXlz0RjPJ4C6Ra0Um6NoAxQhKdkBrdYaqIbZJDYniDD8YxCmiYlpwlk5K6u6qBpGP2/T1Jij5w0hQlQzAJteviLh6S6oiN9kFtzx71U2LceMjSvUUe8AAC2NmyGzV+l1RyppqNh/EfrttR4NbgMeruLgF3llddsdgjg1zLJzvpYnkCgYEA6nandCmxJvQ3YBlw4OXDB1cfo687esByDGOetactd829BQjsnw8hPPm8arA7H6Y9Egtq1B4t13SU+unaBVmm2q5uKkwRMJID0kDzlTRZw4YiCx0NFEIBvX+eKXW0G1tv4RZ9so9KdNS4jaJ4+r7WkEyCutJQf486GmdNsJRIX0sCgYEA2ZpULAXO/KxszU+tgETTC4LfoI5xeqEyWBeYq/9aQjkx8eCTik8I3YpEPmmO+2j8xo4DN+d9ItmZdMD1a4wT983E2y4/7+u9nCBGkjG1nE2V/cRpyp65EJVB7iQ6unLSN4K0vbTU/91NjY6HKycTmvTtxyFl8SFi/xb+MGEhGZsCgYEA6MryrGWQ3Opx6NqZttKp96nLYkvkNJbLJf3rYNUiUedWm58mwS7Wg6I6L3vW2C/IRxhK810biubX3OE/dTx0bH/wJdLs5lqzrJiMwUH/NiEBwCMSD2ESNUJ2mReiwd7hkI0yNI4NET78FrSQhfXhN9ifnDqhbmWY/QpAmug/i00CgYEAuaGyVKvP3DWry6pBNL+B2rwW0f0ySY7iR8w5beE0unHYbaNLuh2aToP5m9SpKUhy+1+C11ofom9HPhauRsUE880SNnjKCn5tDpdqHKVTbLezUP0R0sx8y+zIhcNaZlw1gS17yqpNWskLs8r2/JUlYHe5sLqJIJ9+uGaBCfySJCkCgYAKu+I0uQ/g4o9fraSSY5lBx9sbi517bhX8yj7YJu7L9IGzFL9qO6rYcI9jHOhpIuFRzmyaqZ0ILDYE8PT9pJa62aE4Pu2b1tHIC664gGZ0KaUj19a8FbhW9iiyNVKq+rHtPvPlGRzyrzvPRaKLCtqra3q7uPk+v95993wXkJ31hQ==');
        $gateway->setNotifyUrl('https:/kobeman.com/notify');

        $request = $gateway->purchase();
        $request->setBizContent([
            'subject'      => 'test',
            'out_trade_no' => date('YmdHis') . mt_rand(1000, 9999),
            'total_amount' => '0.01',
            'product_code' => 'QUICK_MSECURITY_PAY',
        ]);

        /**
         * @var AopTradeAppPayResponse $response
         */
        $response = $request->send();
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
