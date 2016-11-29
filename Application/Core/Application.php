<?php
namespace Application\Core;

use Application\Controllers\ErrorController;
use Application\Core\Exceptions\RouterNotFoundRouteException;
use Exception;

/**
 * Class Application
 *
 * @package Application\Core
 */
class Application
{
    const REQUEST_URI = 'REQUEST_URI';
    const CONTROLLER = 'controller';
    const ACTION = 'action';
    /**
     * @var array
     */
    private static $allRoutes;

    /**
     * @param array $server
     * @param array $request
     */
    public static function launch(array $server, array $request)
    {
        try {
            $currentUrl = self::getUrl($server);
            $route = self::getRoute($currentUrl);
            $controller = self::getController($route['controller']);
            $controller->action($server, $request);
        } catch (RouterNotFoundRouteException $exception) {
            (new ErrorController())->action($server, ['error_message' => "404 page not found"]);
        }
    }

    /**
     * @param string $controllerName
     * @return Controller
     */
    private static function getController(string $controllerName): Controller
    {
        $controllerClassName = "Application\\Controllers\\" . $controllerName;

        return new $controllerClassName();
    }

    /**
     * @param array $server
     * @return string
     */
    private static function getUrl(array $server): string
    {
        return $server[self::REQUEST_URI];
    }

    /**
     * @param string $url
     * @return array
     * @throws \Exception
     */
    private static function getRoute(string $url): array
    {
        self::$allRoutes = self::getAllRoutes(dirname(__DIR__) . "/Configs/routes.json");
        foreach (self::$allRoutes as $route) {
            foreach ($route['patterns'] as $pattern) {
                $pattern = str_replace('/', '\/', $pattern);
                if (preg_match('/\*$/', $pattern)) {
                    $pattern = '/' . $pattern . '/';
                } else {
                    $pattern = '/' . $pattern . '$/';
                }
                if (preg_match($pattern, $url)) {
                    return $route;
                }
            }
        }
        throw new RouterNotFoundRouteException("Unknown route for current URL!");
    }

    /**
     * @param array $server
     * @param string $page
     */
    public static function redirectTo(array $server, string $page)
    {
        $host = 'http://' . $server['HTTP_HOST'] . '/';
        header('HTTP/1.1 200 OK');
        header("Status: 200 OK");
        header('Location:' . $host . $page);
    }

    /**
     * @param string $pathToRoutesConfigurationFile
     * @return array
     */
    private static function getAllRoutes(string $pathToRoutesConfigurationFile): array
    {
        self::assertExistsFile($pathToRoutesConfigurationFile);
        self::assertCorrectJsonDecode();

        return json_decode(file_get_contents($pathToRoutesConfigurationFile), true);
    }

    /**
     * @throws Exception
     */
    private static function assertCorrectJsonDecode()
    {
        if (!(json_last_error() == JSON_ERROR_NONE)) {
            throw new Exception(json_last_error_msg());
        }
    }

    /**
     * @param string $pathToRoutesFile
     * @throws Exception
     */
    private static function assertExistsFile(string $pathToRoutesFile)
    {
        if (!file_exists($pathToRoutesFile)) {
            throw new Exception("Путь до файла routes.json указан неверно!");
        }
    }
}