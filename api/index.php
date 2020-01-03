<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

if ($_SERVER['HTTP_HOST'] == 'localhost') {
    define('CONF_ABSPATH', '/var/www/html/private/roto/php/api/config/');
} elseif ($_SERVER['HTTP_HOST'] == '15.206.83.119') {
    define('CONF_ABSPATH', '/var/www/html/roto-php/api/config/');
}

require_once CONF_ABSPATH . 'config.php';
require_once API_ABSPATH . 'core/router/autoload.php';
require_once API_ABSPATH . 'core/router/dispatcher.php';
require_once API_ABSPATH . 'core/service/class.service.php';
require_once API_ABSPATH . 'core/service/class.rest.php';
require_once API_ABSPATH . 'core/http/class.http.php';
require_once API_ABSPATH . 'core/database/class.databasedriver.php';
require_once API_ABSPATH . 'core/database/class.database.php';
require_once API_ABSPATH . 'core/auth/class.tokenserver.php';
require_once API_ABSPATH . 'core/auth/class.basicauth.php';
require_once API_ABSPATH . 'core/parameters/class.parameters.php';
require_once API_ABSPATH . 'core/response/class.response.php';
require_once API_ABSPATH . 'core/common/class.commonfunctions.php';
// require_once API_ABSPATH . 'core/mail/class.mail.php';
require_once API_ABSPATH . 'core/log/LogWritter.php';


class Bootstrap
{

    public static function initialize()
    {

        BasicAuth::enable(); // Enable Basic Authorization
        Db::setEnv('dev'); // Setting environment(dev/prod)
        $dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $router) {

            /**********************************************************
             All routes must be defined here [method][uri][service]
             ************************ START ***************************/

            $router->addRoute(['POST', 'GET', 'PUT', 'DELETE'], URI_PATH . 'login', 'Users');
        });

        Router::dispatch($dispatcher);
    }
}

// Initialize routes
Bootstrap::initialize();
