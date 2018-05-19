<?php declare(strict_types = 1);

namespace App\Api\Response;

use function strpos;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ControllerResultToJsonResponseSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => 'onKernelView',
        ];
    }

    public function onKernelView(GetResponseForControllerResultEvent $event): void
    {
        // Skip if request is not an API-request
        $request = $event->getRequest();
        if (strpos($request->getPathInfo(), '/api/') !== 0) {
            return;
        }

        $data = $event->getControllerResult();

        $event->setResponse(new JsonResponse($data));
    }
}
