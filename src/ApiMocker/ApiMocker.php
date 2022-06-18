<?php

namespace NickOver\ApiMockerBundle\ApiMocker;

use NickOver\ApiMockerBundle\UrlMatcher\UrlMatcherInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiMocker
{
    private LoggerInterface $logger;
    private UrlMatcherInterface $urlMatcher;

    public function __construct(LoggerInterface $logger, UrlMatcherInterface $urlMatcher)
    {
        $this->logger = $logger;
        $this->urlMatcher = $urlMatcher;
    }

    public function handle(Request $request, Response $response): Response
    {
        $attributes = $this->urlMatcher->match($request);

        $this->logger->log(LogLevel::NOTICE, sprintf('Mocker can\'t find route %s', $request->getPathInfo()));
        return $response;
    }
}