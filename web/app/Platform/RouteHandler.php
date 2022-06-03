<?php

namespace App\Platform;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\ControllerDoesNotReturnResponseException;
use Symfony\Component\Routing\Matcher\UrlMatcher;

defined('ROOT_ACCESS') or exit('Restricted Access');

class RouteHandler
{
    protected ?string $controllerNamespace;

    public function __construct(?string $controllerNamespace = null)
    {
        $this->controllerNamespace = $controllerNamespace;
    }

    public function notFound(): Response
    {
        return new Response('Not Found', 404);
    }

    public function serverError(Exception $exception): Response
    {
        return new Response('An error occurred', 500);
    }

    public function controller(UrlMatcher $matcher, array $parameters): Response
    {
        $controller = Arr::get($parameters, '_controller', null);

        $controllerParameters = array_filter($parameters, function ($item, $key) {
            return !Str::startsWith($key, '_');
        }, ARRAY_FILTER_USE_BOTH);

        if (!$controller) throw new ControllerDoesNotReturnResponseException('Not Found', $controller, '', '');

        return $this->handleController($controller, $controllerParameters);
    }

    protected function handleController($controller, array $parameters = [])
    {
        $response = new Response();

        if (is_string($controller)) {
            $response = $this->handleControllerString($controller, $parameters);
        }

        if (is_array($controller)) {
            $response = $this->handleControllerArray($controller, $parameters);
        }

        return $response;
    }

    protected function handleControllerString(string $controller, array $parameters)
    {
        $targetController = explode('::', $controller);
        $controllerClass = Arr::first($targetController);
        $controllerMethod = Arr::last($targetController);

        if ($controllerClass !== $controllerMethod) {
            $content = call_user_func_array([new $controllerClass, $controllerMethod], $parameters);
        } else {
            $content = call_user_func_array([new $controllerClass, '__invoke'], $parameters);
        }

        if (!$content instanceof Response) {
            $content = new Response($content);
        }

        return $content;
    }

    protected function handleControllerArray(array $controller, array $parameters)
    {
        if (count($controller) === 1) return $this->handleControllerString(Arr::first($controller), $parameters);

        $controller = new Collection($controller);
        $controller = $controller->map(function ($item, $index) {
            if ($index === 0 && is_string($item)) {
                return new $item;
            }

            return $item;
        });

        $content = call_user_func_array($controller->toArray(), $parameters);

        if (!$content instanceof Response) {
            $content = new Response($content);
        }

        return $content;
    }
}
