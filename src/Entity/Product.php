<?php declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column()
     */
    public $name;

    /**
     * @ORM\Column(type="text")
     */
    public $description;

    /**
     * @ORM\Column(type="integer")
     */
    public $price;

    /**
     * @ORM\Column(type="integer")
     */
    public $taxRate;

    public static function fromArray(array $raw): self
    {
        $product = new self();

        $product->id = (int) $raw['id'];
        $product->name = $raw['name'];
        $product->description = $raw['description'];
        $product->price = !empty($raw['price']) ? (int) $raw['price'] : null;
        $product->taxRate = !empty($raw['price']) ? (int) $raw['taxRate'] : null;

        return $product;
    }
}
