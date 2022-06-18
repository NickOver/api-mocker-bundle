<?php

namespace NickOver\ApiMockerBundle\UrlMatcher;

use NickOver\ApiMockerBundle\ConfigReader\ConfigReaderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class SymfonyUrlMatcher implements UrlMatcherInterface
{
    private ConfigReaderInterface $configReader;

    public function __construct(ConfigReaderInterface $configReader)
    {
        $this->configReader = $configReader;
    }

    public function match(Request $request): array
    {
        $routes = $this->prepareRoutes();

        $context = new RequestContext();
        $context->fromRequest($request);

        $matcher = new UrlMatcher($routes, $context);

        return $matcher->match($request->getPathInfo());
    }

    private function prepareRoutes(): RouteCollection
    {
        $routes = new RouteCollection();

        foreach ($this->configReader->getDefinedRoutes() as $name => $route) {
            $routes->add($name, new Route($route));
        }

        return $routes;
    }
}