<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Functional\ShoppingCartItems;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Tests\Functional\FunctionalTestCase;

final class DeleteShoppingCartItemTest extends FunctionalTestCase
{
    /** @test */
    public function can_delete_shopping_cart_item(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();
        $shoppingCartItem = factory(ShoppingCartItem::class)->create([
            'shopping_cart_id' => $shoppingCart->id
        ]);

        $response = $this->deleteJson("/shopping-carts/{$shoppingCart->id}/items/{$shoppingCartItem->id}");

        $response->assertStatus(200);
    }

    /** @test */
    public function cannot_delete_shopping_cart_item_through_shopping_cart_that_does_not_own_this_item(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();
        $shoppingCartItem = factory(ShoppingCartItem::class)->create();

        $response = $this->deleteJson("/shopping-carts/{$shoppingCart->id}/items/{$shoppingCartItem->id}");

        $response->assertStatus(404);
    }
}
