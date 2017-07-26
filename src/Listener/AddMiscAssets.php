<?php
/*
* Copyright (c) 2017 Yixuan Qiu
*/

namespace Cosname\Listener;

use Flarum\Event\ConfigureWebApp;
use Illuminate\Contracts\Events\Dispatcher;

class AddMiscAssets
{
    /**
     * Subscribes to the Flarum events.
     *
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(ConfigureWebApp::class, [$this, 'addMiscAssets']);
    }

    /**
     * Add forum assets.
     *
     * @param ConfigureWebApp $event
     */
    public function addMiscAssets(ConfigureWebApp $event)
    {
        if ($event->isForum()) {
            $event->addAssets([
                __DIR__.'/../../js/forum/dist/extension.js'
            ]);

            // Self-hosted fonts
            $event->view->addHeadString('<link rel="stylesheet" href="//uploads.cosx.org/static/css/open-sans.css">', 'font');

            $event->addBootstrapper('cosname/misc/main');
        }
    }
}
