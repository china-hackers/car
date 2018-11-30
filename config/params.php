<?php

return [
    'adminEmail' => 'admin@example.com',
    'host' => 'http://ipche365.cn/',
    'wx'=>[
        //  公众号信息
        'mp'=>[
            /**
             * 账号基本信息，请从微信公众平台
             */
            'app_id'  => 'wx3ea1fbb4979e1453',         // AppID
            'secret'  => '281b50cd02e4a4ce81f4f65af02c4487',     // AppSecret
            'token'   => 'leonidax',          // Token
            'encodingAESKey'=>'',// 消息加解密密钥,该选项需要和公众号后台设置保持一直
            'safeMode'=>0,//0-明文 1-兼容 2-安全，该选项需要和公众号后台设置保持一直

            'payment'=>[
                'mch_id'        =>  '',
                'key'           =>  '',
                'notify_url'    =>  '',
                'cert_path'     => '', // XXX: 绝对路径！！！！
                'key_path'      => '',      // XXX: 绝对路径！！！！
            ],

            'oauth' => [
                'scopes'   => 'snsapi_userinfo',
                'callback' => 'http://ipche365.cn/mobile/api/oauth',
            ],
        ],
        'mini'=>[
            'app_id'  => '',
            'secret'  => '',
            'payment' => [
                'mch_id'        => '',
                'key'           => ''
            ],
        ]
    ],
];
