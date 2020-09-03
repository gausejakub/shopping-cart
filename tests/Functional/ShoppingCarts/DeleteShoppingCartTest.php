<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Functional\ShoppingCarts;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Tests\Functional\FunctionalTestCase;

final class DeleteShoppingCartTest extends FunctionalTestCase
{
    /** @test */
    public function can_delete_shopping_cart(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();

        $response = $this->deleteJson("/shopping-carts/" . $shoppingCart->id);

        $response->assertStatus(200);
    }
}
