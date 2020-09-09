<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Functional\ShoppingCartItems;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Tests\Functional\FunctionalTestCase;

final class StoreShoppingCartItemTest extends FunctionalTestCase
{
    /** @test */
    public function can_create_shopping_cart_item(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();

        $response = $this->postJson("/shopping-carts/{$shoppingCart->id}/items", [
            'name' => 'test',
            'price' => 69,
            'quantity' => 1,
        ]);

        $response->assertStatus(200);
    }
}
