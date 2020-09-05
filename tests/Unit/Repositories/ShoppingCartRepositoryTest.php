<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Repositories;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Repositories\ShoppingCartRepository;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;

final class ShoppingCartRepositoryTest extends UnitTestCase
{
    /** @test */
    public function can_find_shopping_cart_by_owner_id(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();

        $shoppingCartRepository = new ShoppingCartRepository();

        $returnedShoppingCart = $shoppingCartRepository->findByOwnerId($shoppingCart->owner_id);

        $this->assertInstanceOf(ShoppingCart::class, $shoppingCart);
        $this->assertEquals($shoppingCart->fresh(), $returnedShoppingCart);
    }

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

    /** @test */
    public function can_delete_shopping_cart(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();
        $shoppingCartRepository = new ShoppingCartRepository();

        $result = $shoppingCartRepository->delete($shoppingCart);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('shopping_carts', [
            'id' => $shoppingCart->id,
        ]);
    }
}
