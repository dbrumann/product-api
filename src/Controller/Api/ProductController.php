<?php declare(strict_types = 1);

namespace App\Controller\Api;

use App\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
            throw new NotFoundHttpException(sprintf('Could not find a product with id "%d".', $id));
        }

        return $product;
    }

    /**
     * @Route("/products", name="products_create", methods={"POST"})
     */
    public function createProduct(Product $product)
    {
        $manager = $this->getDoctrine()->getManagerForClass(Product::class);

        $manager->persist($product);
        $manager->flush();

        $headers = [
            'Location' => $this->generateUrl('api_product_get', ['id' => $product->id]),
        ];

        return new JsonResponse(null, JsonResponse::HTTP_CREATED, $headers);
    }

    /**
     * @Route("/products/{id}", name="products_update", methods={"POST"})
     */
    public function updateProduct(int $id, Product $product)
    {
        $existingProduct = $this->getProduct($id);

        $existingProduct->name = $product->name ?? $existingProduct->name;
        $existingProduct->description = $product->description ?? $existingProduct->description;
        $existingProduct->price = $product->price ?? $existingProduct->price;
        $existingProduct->taxRate = $product->taxRate ?? $existingProduct->taxRate;

        $manager = $this->getDoctrine()->getManagerForClass(Product::class);
        $manager->flush();

        return $existingProduct;
    }

    /**
     * @Route("/products/{id}", name="products_delete", methods={"DELETE"})
     */
    public function deleteProduct(int $id)
    {
        $existingProduct = $this->getProduct($id);

        $manager = $this->getDoctrine()->getManagerForClass(Product::class);
        $manager->remove($existingProduct);
        $manager->flush();

        return new JsonResponse(null, JsonResponse::HTTP_NO_CONTENT);
    }
}
