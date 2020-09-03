<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Functional\ShoppingCarts;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Tests\Functional\FunctionalTestCase;

final class StoreShoppingCartTest extends FunctionalTestCase
{
    /** @test */
    public function can_create_shopping_cart(): void
    {
        $response = $this->postJson("/shopping-carts", [
            'owner_id' => 'testing-owner-id'
        ]);

        $response->assertStatus(200);
    }
}
