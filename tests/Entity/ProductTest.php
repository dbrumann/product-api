<?php declare(strict_types = 1);

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function test_it_can_be_created_from_raw_data()
    {
        $raw = [
            'id' => '123',
            'name' => 'My product',
            'description' => 'A product that I find useful.',
            'price' => '3999', // equals "39.99 €"
            'taxRate' => '1900', // equals "19.00%" tax rate
        ];

        $product = Product::fromArray($raw);

        $this->assertSame(123, $product->id);
        $this->assertSame('My product', $product->name);
        $this->assertSame('A product that I find useful.', $product->description);
        $this->assertSame(3999, $product->price);
        $this->assertSame(1900, $product->taxRate);
    }
}
