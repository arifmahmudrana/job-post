<?php
require __DIR__.'/../vendor/autoload.php';

require __DIR__.'/../bootstrap/Bootstrap.php';
//set base url
Bootstrap::setBaseUrl();
//set db connection
Bootstrap::setUpDB();
//load routes
Bootstrap::setUpRoutes();

require __DIR__.'/../bootstrap/Events.php';
Events::attachEvents();

require __DIR__.'/../bootstrap/Dispatcher.php';
//dispatch to handler
Dispatcher::dispatch();