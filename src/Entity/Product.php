<?php declare(strict_types = 1);

namespace App\Entity;

class Product
{
    public $id;

    public $name;

    public $description;

    public $price;

    public $taxRate;

    public static function fromArray(array $raw): self
    {
        $product = new self();

        $product->id = (int) $raw['id'];
        $product->name = $raw['name'];
        $product->description = $raw['description'];
        $product->price = (int) $raw['price'];
        $product->taxRate = (int) $raw['taxRate'];

        return $product;
    }
}
