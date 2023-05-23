<?php
use MyProject\Router;

require __DIR__ . '/vendor/autoload.php';
try {
    ini_set('display_errors','On');
    error_reporting(E_ALL);

    $router = new Router;
    $controllerName = 'MyProject\Controllers\\' . $router->getController();
    $actionName = $router->getAction();

    $controller = new $controllerName;
    if(isset($router->args)) {
        $controller->$actionName(...$router->args);            
    } else {
        $controller->$actionName();
    }
} catch (\MyProject\Exceptions\DbException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('500.php', ['error' => $e->getMessage()], 500);
} catch (\MyProject\Exceptions\NotFoundException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('404.php', ['error' => $e->getMessage()], 404);
} catch (\MyProject\Exceptions\UnauthorizedException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('401.php', ['error' => $e->getMessage()], 401);
} catch (\MyProject\Exceptions\ForbiddenException $e) {
    $view = new \MyProject\View\View(__DIR__ . '/templates/errors');
    $view->renderHtml('403.php', ['error' => $e->getMessage()], 403);
} catch (\MyProject\Exceptions\UnauthorizedException $e) {
    $view = new \MyProject\View(__DIR__ . '/templates/errors');
    $view->renderHtml('422.php', ['error' => $e->getMessage()], 422);
}
