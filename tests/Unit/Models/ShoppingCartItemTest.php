<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Models;


use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;

final class ShoppingCartItemTest extends UnitTestCase
{
    /** @test */
    public function has_total_price_attribute(): void
    {
        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = factory(ShoppingCartItem::class)->create([
            'quantity' => 1,
            'price' => 1000,
        ]);

        $this->assertEquals(1000, $shoppingCartItem->totalPrice);

        $shoppingCartItem = factory(ShoppingCartItem::class)->create([
            'quantity' => 2,
            'price' => 1000,
        ]);

        $this->assertEquals(2000, $shoppingCartItem->totalPrice);
    }
}
