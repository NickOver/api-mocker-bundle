<?php

namespace NickOver\ApiMockerBundle\ConfigReader;

class ConfigReader implements ConfigReaderInterface
{
    public function getDefinedRoutes(): array
    {
        return [
            '/test/',
        ];
    }
}