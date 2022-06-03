<?php

namespace App\Platform;

use Composer\Autoload\ClassLoader;
use Exception;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\ControllerDoesNotReturnResponseException;
use Symfony\Component\Routing;

defined('ROOT_ACCESS') or exit('Restricted Access');

class Core
{
    protected ClassLoader $classLoader;
    protected Request $request;

    protected string $routePath = ROOT_PATH . '/config/routes.php';
    protected string $controllerPath = ROOT_PATH . '/app/Controllers/';

    protected ?string $controllerNamespace = "\\App\\Controllers\\";

    public function __construct(ClassLoader $classLoader)
    {
        $this->classLoader = $classLoader;
        $this->request = Request::createFromGlobals();
    }

    /**
     * @param string $routePath
     */
    public function setRoutePath(string $routePath): void
    {
        $this->routePath = $routePath;
    }

    /**
     * @param string $controllerPath
     */
    public function setControllerPath(string $controllerPath): void
    {
        $this->controllerPath = $controllerPath;
    }

    /**
     * @param string|null $controllerNamespace
     */
    public function setControllerNamespace(?string $controllerNamespace = null): void
    {
        $this->controllerNamespace = $controllerNamespace;
    }

    public function handle(): void
    {
        $this->request = Request::createFromGlobals();
        $routes = $this->loadRoutes();
        $context = $this->loadContext();
        $routeHandlers = new RouteHandler();

        try {
            $matcher = new Routing\Matcher\UrlMatcher($routes, $context);
            $parameters = $matcher->match($context->getPathInfo());
            $response = $routeHandlers->controller($matcher, $parameters);
        } catch (Routing\Exception\ResourceNotFoundException|ControllerDoesNotReturnResponseException $exception) {
            $response = $routeHandlers->notFound();
        } catch (Exception $exception) {
            $response = $routeHandlers->serverError($exception);
        }

        $response->send();
    }

    protected function loadRoutes(): Routing\RouteCollection
    {
        $routeLoader = new Routing\Loader\PhpFileLoader(new FileLocator($this->controllerPath));

        return $routeLoader->load($this->routePath);
    }

    protected function loadContext(): Routing\RequestContext
    {
        $context = Routing\RequestContext::fromUri($_SERVER['REQUEST_URI']);
        $context->fromRequest($this->request);
        return $context;
    }
}
