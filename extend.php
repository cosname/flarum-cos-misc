<?php

use Flarum\Extend;
use Cosname\Listener;
use Illuminate\Contracts\Events\Dispatcher;

return [
    // Load JS script
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js'),

    // Add customized CSS
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            $document->head = [
                '<link rel="stylesheet" href="//uploads.cosx.org/static/css/open-sans.css">'
            ];
        }),
    
    // Add listener
    function (Dispatcher $events) {
        $events->subscribe(Listener\CheckEmailDomain::class);
    }
];
