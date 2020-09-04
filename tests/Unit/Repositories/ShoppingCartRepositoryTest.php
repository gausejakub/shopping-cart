<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Repositories;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Repositories\ShoppingCartRepository;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;

final class ShoppingCartRepositoryTest extends UnitTestCase
{
    /** @test */
    public function can_create_shopping_cart(): void
    {
        $shoppingCartRepository = new ShoppingCartRepository();

        $shoppingCart = $shoppingCartRepository->create('testing-owner-id');

        $this->assertInstanceOf(ShoppingCart::class, $shoppingCart);
        $this->assertDatabaseHas('shopping_carts', [
            'id' => $shoppingCart->id,
            'owner_id' => 'testing-owner-id',
        ]);
    }
}
