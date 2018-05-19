<?php declare(strict_types = 1);

namespace App\Tests\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function test_products_list_is_accessible()
    {
        $client = static::createClient();

        $client->request('GET', '/api/products');
        $response = $client->getResponse();

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertSame('application/json', $response->headers->get('Content-Type'));
        $this->assertJsonStringEqualsJsonString(
            '[{"id":123,"name":"Apple","description":"A tasty snack.","price":49,"taxRate":700}]',
            $response->getContent()
        );
    }

    public function test_not_found_returns_json_error()
    {
        $client = static::createClient();

        $client->request('GET', '/api/spaceships');
        $response = $client->getResponse();

        $this->assertEquals(404, $response->getStatusCode());
        $this->assertSame('application/json', $response->headers->get('Content-Type'));
        $this->assertJsonStringEqualsJsonString(
            '{"type":"NotFoundHttpException","message":"No route found for \"GET \/api\/spaceships\""}',
            $response->getContent()
        );
    }
}
