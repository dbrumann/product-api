<?php declare(strict_types = 1);

namespace App\Controller\Api;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api", name="api_")
 */
final class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="products_list", methods={"GET"})
     */
    public function listProducts()
    {
        return $this->getDoctrine()->getRepository(Product::class)->findAll();
    }

    /**
     * @Route("/products/{id}", name="product_get", requirements={"id": "\d+"}, methods={"GET"})
     */
    public function getProduct(int $id)
    {
        $product = $this->getDoctrine()->getRepository(Product::class)->find($id);
        if (!$product) {
            $this->createNotFoundException(sprintf('Could not find a product with id "%d".', $id));
        }

        return $product;
    }
}
