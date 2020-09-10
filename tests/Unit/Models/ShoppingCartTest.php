<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Models;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /** @test */
    public function has_many_items(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();

        $relationship = $shoppingCart->items();

        $this->assertInstanceOf(HasMany::class, $relationship);
    }

    /** @test */
    public function has_total_attribute(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();
        factory(ShoppingCartItem::class)->create([
            'shopping_cart_id' => $shoppingCart->id,
            'price' => 6900,
            'quantity' => 3,
        ]);
        factory(ShoppingCartItem::class)->create([
            'shopping_cart_id' => $shoppingCart->id,
            'price' => 1000,
            'quantity' => 2,
        ]);


        $this->assertEquals(22700, $shoppingCart->total);
    }
}
