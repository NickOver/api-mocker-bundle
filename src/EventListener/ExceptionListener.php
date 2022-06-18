<?php

namespace NickOver\ApiMockerBundle\EventListener;

use NickOver\ApiMockerBundle\ApiMocker\ApiMocker;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExceptionListener
{
    private ApiMocker $apiMocker;

    public function __construct(ApiMocker $apiMocker)
    {
        $this->apiMocker = $apiMocker;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        if ($event->getThrowable() instanceof NotFoundHttpException) {
            $response = $this->apiMocker->handle(
                $event->getRequest(),
                $event->getResponse()
            );

            $event->setResponse($response);
        }
    }
}
