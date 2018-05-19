<?php declare(strict_types = 1);

namespace App\Api\Request;

use App\Entity\Product;
use Generator;
use function json_decode;
use function strpos;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

final class ProductArgumentValueResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return (
            strpos($request->getPathInfo(), '/api/products') === 0
            && $argument->getType() === Product::class
            && !empty($request->getContent())
        );
    }

    public function resolve(Request $request, ArgumentMetadata $argument): Generator
    {
        $raw = json_decode($request->getContent(), true);
        $product = Product::fromArray($raw);

        yield $product;
    }
}
