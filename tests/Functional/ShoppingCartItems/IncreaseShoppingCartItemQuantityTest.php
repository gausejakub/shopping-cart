<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Functional\ShoppingCartItems;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Tests\Functional\FunctionalTestCase;

final class IncreaseShoppingCartItemQuantityTest extends FunctionalTestCase
{
    /** @test */
    public function can_increase_shopping_cart_item_quantity(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();
        $shoppingCartItem = factory(ShoppingCartItem::class)->create([
            'shopping_cart_id' => $shoppingCart->id,
            'quantity' => 10,
        ]);

        $response = $this->postJson("/shopping-carts/{$shoppingCart->id}/items/{$shoppingCartItem->id}/increase");

        $response->assertStatus(200);
    }

    /** @test */
    public function cannot_increase_shopping_cart_item_quantity_through_shopping_cart_that_does_not_own_this_item(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();
        $shoppingCartItem = factory(ShoppingCartItem::class)->create();

        $response = $this->postJson("/shopping-carts/{$shoppingCart->id}/items/{$shoppingCartItem->id}/increase");

        $response->assertStatus(404);
    }
}
