<?php
return [
    'lryokpay' => [
        'mch_id' => '861100000012824',
        'secret' => 'A22A810CB7F194F81AEE91DA74095875',
        'countryCode' => 'MYR',
        'ccy_no' => 'PHP',
        'bankCode' => 'PHP',
        'busi_code' => '101202',//菲律宾手机号支付
        't1' => [
            'busi_code' => '101202',
        ],
        't2' =>[
            'busi_code' => '101204',
        ],
        'private' => 'MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAL3GwKiZnL4Z/DegZlRzYe1U1APY2zkNJV4vvDNkdXHGKC95eGIA9XPsXPTY5Kf8XYVrCWJkBof1e9LlIGfiVgu+5qWhIMv7ekOCTb3vnCRpOso4xipJ4wi9i15YfOVXn07WAJLV+T8RCj52sSbs3NOLK6zyXO/gGLRUot31TgcJAgMBAAECgYAIitfFPxTlIbpOrrOsfX0c98KLYcmMaeESukdYcN8wfeD1MhyPHMfvreYJR3ITdbKn/MdxXFtG52/pcFLjGjcRQFyrW8Wf955+tgJTAvkWkHJguQOOp88xarRqXsYRrK9Qjhz93IUhbOcSipSuPEn+xZZwJ6Ki9/io6MSIPvEYGQJBAPDhqoGd2y6x9OsWbNf0GKQr6aV4kOX16MmjpoDvY0ddeWuBC+4oO7SQCtLTr0R6wiMj/F7AhVLAAmxu0Af8YlMCQQDJr/YNM9H4049I2dpwViqHtb1lSR2GIW7uXaUq/yaIRj0UoCiIGWRgxev9fT6laZzPijqMxgSevBFqEv18Cr2zAkEAkbU/6ZXuTqmw6D+xaVQrT6uMct6ib6g3vzkx785etH2Tg/cUm2RU8V0sXulTnM3Q/2a2My6rtymUjbjeN+ZwJwJAffai4r4Bnrlq3OIK9mwqZdXQ8whGIzaQVNkxxffTNftAPLiGd/H76iDS8d+eF6stX8WCKdemnQjyi2BO5oDC1wJADETf+wnsPHjDvNGx66Y1c7DxPqZLvQ1YNw7cHawwVJq7VzZNTMdAkx++VU8tQVuhNg2Fr8xof+O2AyBT3SE1eQ==',
        'main_public' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCnRoh0lR93cmk6bZs9Pkd9HIg99m3W7czZfQr+G9O3FGKdfCEr3Dm8I0Mhz0u6v9v65uWQh5px2U0RPhbU2DZtMUSKd9TsbP/yAL7djplajqke2vKKit2jVxDFympQe13IBmDR8rxqGvukFHHglOpC1Km+HncpajAO+PJ255xY7wIDAQAB'
    ],
    'sexypay' => [
        'mch_id' => '',
        'secret' => '',
    ],
    'trc20pay' => [
        'mch_id' => 0,
        'secret' => '',
        'channel' => 'tron.contract.USDT',
        'payout_channel' => 'tron.contract.USDT',
        'pay_exchange' => 1, //充值对应美元汇率
        'pay_out_exchange' => 1, //提现对应美元汇率
        'recharge_type' => 2, //平台本身对应的ID
    ],
    'bankspay' => [
        'mch_id' => '',
        'secret' => '',
        'pay_type' => '151',
    ],
    'stepay' => [
        'mch_id' => '',
        'secret' => '',
        'payout_secret' => '',
        'currency' => 'BRL',
        'pay_type' => 26,
        'payout_currency' => 'BRL',
        'payout_pay_type' => 30,
    ],
    'threektmxpay' => [
        'mch_id' => '',
        'secret' => '',
        'payout_secret' => '',
        'pay_type' => 101,
    ],
    'brotherpay' => [
        'mch_id' => 0,
        'secret' => '',
        'app_id' => '',
        'pay_type' => 9000
    ],
    'speedlyppay' => [
        'mch_id' => 0,
        'secret' => '',
        'pay_type' => 101
    ],
    'qeapay' => [
        'mch_id' => '',
        'secret' => '',
        'pay_type' => '620',
        'payout_secret' => '',
    ],
    'tikpay' => [
        'mch_id' => '',
        'secret' => '',
        'paymentId' => '26',
        'iv' => '!WFNZFU_{H%M(S|a',
        'rechargeUrl' => 'https://pay.soon-ex.com/brazil/#/?orderId=', //正式
        //'rechargeUrl' => 'https://paytest.soon-ex.com/turkey/#/?orderId=' //测试
    ],
    'guaranapay' => [
        'mch_id' => '',
        'secret' => '',
        'country' => 'BR',
        'currency' => 'BRL',
        'payout_mch_id' => '',
        'payout_secret' => '',
    ]
];