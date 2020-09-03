<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Functional\ShoppingCarts;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Tests\Functional\FunctionalTestCase;

final class GetShoppingCartTest extends FunctionalTestCase
{
    /** @test */
    public function can_get_shopping_cart(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();

        $response = $this->getJson("/shopping-carts/" . $shoppingCart->id);

        $response->assertStatus(200);
    }
}
