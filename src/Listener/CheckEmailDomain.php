<?php

namespace Cosname\Listener;

use Flarum\Foundation\Event\Validating;
use Flarum\User\UserValidator;
use Illuminate\Contracts\Events\Dispatcher;

class CheckEmailDomain
{
    // Black list of email domains
    private static $blacklist = [
        '119mail.com',
        '120mail.com',
        '263mali.cn',
        '4533.top',
        '4qmail.com',
        '4tmail.com',
        'alivemail.ga',
        'bcaoo.com',
        'clsn1.com',
        'dawin.com',
        'emailnube.com',
        'eveav.com',
        'fxmail.ws',
        'hotmali.cn',
        'huaweimali.cn',
        'imail1.net',
        'imail5.net',
        'inwmail.net',
        'jancloud.net',
        'janmail.org',
        'jnpayy.com',
        'juyouxi.com',
        'mail1web.org',
        'mail3plus.net',
        'mail3tech.com',
        'mailer9.net',
        'mailernam.com',
        'mailon.ws',
        'mailt.net',
        'mailt.top',
        'master-mail.net',
        'moakt.ws',
        'mtsg.me',
        'newe-mail.com',
        'oiizz.com',
        'oncloud.ws',
        'onmail.top',
        'promail9.net',
        'qmailshop.com',
        'ryo.shp7.cn',
        'sammail.ws',
        'seo-mailer.com',
        'seomail.org',
        'seomail.top',
        'sweatmail.com',
        'tmail2.com',
        'tmailer.org',
        'topmail.ws',
        'topmail2.net',
        'upcmaill.com',
        'wmail1.com',
        'x-netmail.com',
        'yopmail.com',
        'yxpf.xyz',
        'zzrgg.com'
    ];

    private function blacklist_regex()
    {
        // Escape dot
        $regex = str_replace('.', '\\.', self::$blacklist);
        // Suffix
        $regex = preg_replace('/$/', '$', $regex);
        // Merge rules
        $regex = implode('|', $regex);
        return $regex;
    }

    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(Validating::class, [$this, 'checkEmailDomain']);
    }

    /**
     * @param Validating $event
     */
    public function checkEmailDomain(Validating $event)
    {
        // https://discuss.flarum.org/d/4238-how-to-add-custom-validate-for-post
        if ($event->type instanceof UserValidator) {
            // The 'regex' rule is used to detect QQ mails, associated with a warning message
            // The 'not_regex' rule is used to prevent spams
            $event->validator->addRules([
                'email' => [
                    'regex:/.*(?<!qq\\.com)$/i',  // see https://stackoverflow.com/a/16398813
                    'not_regex:/' . $this->blacklist_regex() . '/i'
                ]
            ]);
            $event->validator->setCustomMessages([
                'email.regex' => '请避免使用 QQ 邮箱',
                'email.not_regex' => '请证明你不是机器人！'
            ]);
        }
    }
}
