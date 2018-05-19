<?php declare(strict_types = 1);

namespace App\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/api", name="api_")
 */
final class ProductController
{
    /**
     * @Route("/products", name="products_list", methods={"GET"})
     */
    public function listProducts()
    {
        return [];
    }
}
