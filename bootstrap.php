<?php
/*
* Copyright (c) 2017 Yixuan Qiu
*/

use Cosname\Listener;
use Illuminate\Contracts\Events\Dispatcher;

return function (Dispatcher $events) {
    $events->subscribe(Listener\AddMiscAssets::class);
    $events->subscribe(Listener\CheckEmailDomain::class);
};
