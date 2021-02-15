<?php

spl_autoload_register(static function (string $className) {
    require_once dirname(__DIR__) . '/src/' . str_replace('\\', '/',$className) . '.php';
});

/*require __DIR__ . '/../src/MyProject/Models/Users/User.php';
require __DIR__ . '/../src/MyProject/Controllers/MainController.php';
require __DIR__ . '/../src/MyProject/Services/Db.php';*/

$route = $_GET['route'] ?? '';
$routes = require __DIR__ . '/../src/routes.php';


$isRouteFound = false;
foreach ($routes as $pattern => $controllerAndAction) {
    preg_match($pattern, $route, $matches);
    if (!empty($matches)) {
        $isRouteFound = true;
        break;
    }
}


if (!$isRouteFound) {
    echo '404 - page not found';
    return;
}
unset($matches[0]);

$controllerName = $controllerAndAction[0];
$actionName = $controllerAndAction[1];

$controller = new $controllerName();
$controller->$actionName(...$matches);