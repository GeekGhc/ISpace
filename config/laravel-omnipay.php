<?php

return [

	// The default gateway to use
	'default' => 'alipay',

	// Add in each gateway here
	'gateways' => [
		'paypal' => [
			'driver'  => 'PayPal_Express',
			'options' => [
				'solutionType'   => '',
				'landingPage'    => '',
				'headerImageUrl' => ''
			]
		],
        'alipay' => [
            'driver' => 'Alipay_Express',
            'options' => [
                'partner' => ' 2088612117719032',
                'key' => ' 2017020805574567',
                'sellerEmail' =>'your alipay account here',
                'returnUrl' => 'https://kobeman.com/alipay/callback',
                'notifyUrl' => 'your notifyUrl here'
            ]
        ]
	]

];