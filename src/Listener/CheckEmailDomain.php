<?php

namespace Cosname\Listener;

use Flarum\Foundation\Event\Validating;
use Flarum\User\UserValidator;
use Illuminate\Contracts\Events\Dispatcher;

class CheckEmailDomain
{
    // Black list of email domains
    private static $blacklist = [
        'mail1web.org',
        'tmailer.org',
        'yxpf.xyz',
        'mailt.top',
        'hotmali.cn',
        '263mali.cn',
        '120mail.com',
        '4tmail.com',
        'tmail2.com',
        'huaweimali.cn',
        'oiizz.com',
        'dawin.com',
        'eveav.com',
        'zzrgg.com',
        'juyouxi.com',
        'jnpayy.com',
        'moakt.ws',
        '119mail.com',
        'yopmail.com',
        'mail3tech.com',
        'alivemail.ga',
        'imail1.net',
        'topmail2.net',
        'mail3plus.net',
        'mailt.net',
        'master-mail.net'
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
