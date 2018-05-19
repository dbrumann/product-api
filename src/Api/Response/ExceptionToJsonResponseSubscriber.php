<?php declare(strict_types = 1);

namespace App\Api\Response;

use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use function end;
use function explode;
use function get_class;

final class ExceptionToJsonResponseSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        // Skip if request is not an API-request
        $request = $event->getRequest();
        if (strpos($request->getPathInfo(), '/api/') !== 0) {
            return;
        }

        $exception = $event->getException();
        $error = [
            'type' => $this->getErrorTypeFromException($exception),
            // Warning! Passing the exception message without checks is insecure.
            // This will potentially leak sensitive information.
            // Do not use this in production!
            'message' => $exception->getMessage(),
        ];
        $response = new JsonResponse($error, $this->getStatusCodeFromException($exception));

        $event->setResponse($response);
    }

    private function getStatusCodeFromException(Exception $exception): int
    {
        if ($exception instanceof HttpException) {
            return $exception->getStatusCode();
        }

        return 500;
    }

    private function getErrorTypeFromException(Exception $exception): string
    {
        $parts = explode('\\', get_class($exception));

        return end($parts);
    }
}
