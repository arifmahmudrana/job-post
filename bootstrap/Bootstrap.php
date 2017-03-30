<?php

class Bootstrap
{
    public static function setBaseUrl()
    {
        $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $base_url .= "://". @$_SERVER['HTTP_HOST'];
        $base_url .=     str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
        ArifMahmudRana\Context\ContextContainer::set(
            'baseUrl', $base_url
        );
    }

    public static function setUpDB()
    {
        $dbConfigs = require_once __DIR__ . '/../config/database.php';
        require_once __DIR__ . '/../ExternalLibs/sparrow.php';
        $db = new \Sparrow();
        $db->setDb($dbConfigs);
        ArifMahmudRana\Context\ContextContainer::set(
            'db', $db
        );
    }

    public static function setUpRoutes()
    {
        $routes = require_once __DIR__ . '/../config/routes.php';

        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) use ($routes) {
            foreach ($routes as $route)
            {
                $r->addRoute(...$route);
            }
        });

        ArifMahmudRana\Context\ContextContainer::set('dispatcher', $dispatcher);
    }
}