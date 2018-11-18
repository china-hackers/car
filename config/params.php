<?php

return [
    'adminEmail' => 'admin@example.com',
    'host' => 'http://test.iamlk.cn/',
    'wx'=>[
        //  公众号信息
        'mp'=>[
            /**
             * 账号基本信息，请从微信公众平台
             */
            'app_id'  => 'wx98209793ce9472a7',         // AppID
            'secret'  => 'a08bb61d90df4043b8993777b11032bd',     // AppSecret,677599f3b1d5728f87315e5ffb7674fb
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
                'callback' => 'http://test.iamlk.cn/mobile/api/oauth',
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
