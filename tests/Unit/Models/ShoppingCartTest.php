<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Models;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
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
}
