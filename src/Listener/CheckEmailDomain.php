<?php

namespace Cosname\Listener;

use Flarum\Event\ConfigureValidator;
use Flarum\Core\Validator\UserValidator;
use Illuminate\Contracts\Events\Dispatcher;

class CheckEmailDomain
{
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureValidator::class, [$this, 'checkEmailDomain']);
    }

    /**
     * @param ConfigureValidator $event
     */
    public function checkEmailDomain(ConfigureValidator $event)
    {
        // https://discuss.flarum.org/d/4238-how-to-add-custom-validate-for-post
        if ($event->type instanceof UserValidator) {
            $event->validator->mergeRules('email', [
                'regex:/.*(?<!qq\\.com)$/i'
            ]);
            $event->validator->setCustomMessages([
                'email.regex' => '请避免使用QQ邮箱',
            ]);
        }
    }
}
