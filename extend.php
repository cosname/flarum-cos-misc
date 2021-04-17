<?php

use Flarum\Extend;
use Flarum\Frontend\Document;
use Flarum\User\UserValidator;
use Cosname\Listener;

return [
    // Load JS script
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),

    // Add customized CSS
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            $document->head[] = '<link rel="stylesheet" href="//uploads.cosx.org/static/css/open-sans.css">';
        }),

    // Add listener
    // See https://github.com/flarum/core/blob/master/tests/integration/extenders/ValidatorTest.php
    (new Extend\Validator(UserValidator::class))
        ->configure(Listener\CheckEmailDomain::class)
];
