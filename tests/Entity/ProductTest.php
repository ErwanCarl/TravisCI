<?php

namespace App\Tests\Entity;

use App\Entity\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testComputeTVAOtherProduct()
    {
        $product = new Product('Sauvignon', 'wine', 20);
        $this->assertSame(3.92, $product->computeTVA());
    }

    /**
    * @dataProvider pricesForFoodProduct
    */
    public function testcomputeTVAFoodProduct($price, $expectedTva)
    {
        $product = new Product('Pomme', Product::FOOD_PRODUCT, $price);
        $this->assertSame($expectedTva, $product->computeTVA());
    }

    public static function pricesForFoodProduct()
    {
        return [
            [0, 0.0],
            [20, 1.1],
            [100, 5.5]
        ];
    }

    public function testNegativePriceComputeTVA()
    {
        $product = new Product('Un produit', Product::FOOD_PRODUCT, -20);
        $this->expectException('Exception');
        $product->computeTVA();
    }
}
