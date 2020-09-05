<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Functional\ShoppingCartItems;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Tests\Functional\FunctionalTestCase;

final class GetShoppingCartItemsTest extends FunctionalTestCase
{
    /** @test */
    public function can_get_shopping_cart_items(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();

        $response = $this->getJson("/shopping-carts/{$shoppingCart->id}/items");

        $response->assertStatus(200);
    }
}
