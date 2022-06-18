<?php

namespace NickOver\ApiMockerBundle\ConfigReader;

interface ConfigReaderInterface
{
    public function getDefinedRoutes(): array;
}