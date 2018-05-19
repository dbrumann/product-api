<?php declare(strict_types = 1);

namespace App\Controller\Api;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
        return $this->createExampleProducts();
    }

    private function createExampleProducts(): array
    {
        $product = new Product();
        $product->id = 123;
        $product->name = 'Apple';
        $product->description = 'A tasty snack.';
        $product->price = 49;
        $product->taxRate = 700;

        return [$product];
    }
}
