<?php

namespace NickOver\ApiMockerBundle\UrlMatcher;

use Symfony\Component\HttpFoundation\Request;

interface UrlMatcherInterface
{
    public function match(Request $request): array;
}