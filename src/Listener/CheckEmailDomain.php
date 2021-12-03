<?php

namespace Cosname\Listener;

class CheckEmailDomain
{
    // White list of email domains, obtained from existing users
    private static $whitelist = [
        'cos.name',
        'cosx.org',
        '163.com',
        'yahoo.com',
        'gmail.com',
        '126.com',
        'hotmail.com',
        'sina.com',
        'yahoo.com.cn',
        'outlook.com',
        'sohu.com',
        'yahoo.cn',
        'tom.com',
        'yeah.net',
        'foxmail.com',
        '21cn.com',
        'msn.com',
        'yandex.com',
        'yahoo.com.tw',
        'live.cn',
        'yahoo.com.hk',
        'sina.com.cn',
        'sina.cn',
        'eyou.com',
        '139.com',
        'aol.com',
        'live.com',
        'aliyun.com',
        'mail.com',
        'vip.sina.com',
        '263.net',
        'yahoo.co.uk',
        'googlemail.com',
        'yahoo.ca',
        '189.cn',
        'yahoo.co.jp',
        'sogou.com',
        'hotmail.fr',
        'vip.163.com',
        '163.net',
        'etang.com',
        'yahoo.com.au',
        'msn.cn',
        'hotmail.co.jp',
        '163.com.cn',
        '56.com',
        'huawei.com',
        'hotmail.co.uk',
        'yahoo.fr',
        'china.com.cn',
        'ac.cn',
        'protonmail.ch',
        'protonmail.com',
        'pm.me',
        'jointsurg.com'
    ];

    private function whitelist_regex()
    {
        // Escape dot
        $regex = str_replace('.', '\\.', self::$whitelist);
        // Suffix
        $regex = preg_replace('/$/', '$', $regex);
        // Merge rules
        $regex = implode('|', $regex);
        // Rules for edu emails: end with .edu or .edu.**
        $regex = $regex . '|\\.edu$|\\.edu\\.[^.]*$';
        return $regex;
    }

    public function __invoke($flarumValidator, $validator)
    {
        $validator->addRules([
            'email' => [
                'regex:/' . $this->whitelist_regex() . '/i'
            ]
        ]);
        $validator->setCustomMessages([
            'email.regex' => '请使用常见邮箱注册（避免使用 QQ 邮箱），或到 https://github.com/cosname/flarum-cos-misc/issues 申请开启白名单。'
        ]);
    }
}
