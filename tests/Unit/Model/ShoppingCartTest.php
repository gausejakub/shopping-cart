<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Model;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;

final class ShoppingCartTest extends UnitTestCase
{
    /** @test */
    public function uuid_is_created_by_default_for_shopping_cart(): void
    {
        $shoppingCart = ShoppingCart::create([
            'owner_id' => 'testing-owner-id',
        ]);

        $id = $shoppingCart->id;
        $this->assertDatabaseHas('shopping_carts', [
            'id' => $id,
            'owner_id' => 'testing-owner-id',
        ]);
    }
}
