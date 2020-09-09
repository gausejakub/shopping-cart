<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Repositories;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Repositories\ShoppingCartItemRepository;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;

final class ShoppingCartItemRepositoryTest extends UnitTestCase
{
    /** @test */
    public function can_create_shopping_cart_item(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();

        /** @var ShoppingCartItemRepository $shoppingCartItemRepository */
        $shoppingCartItemRepository = app(ShoppingCartItemRepository::class);

        $shoppingCartItem = $shoppingCartItemRepository->create(
            $shoppingCart,
            'Testing item name',
            6900,
            1
        );

        $this->assertInstanceOf(ShoppingCartItem::class, $shoppingCartItem);
        $this->assertDatabaseHas('shopping_cart_items', [
            'id' => $shoppingCartItem->id,
            'name' => 'Testing item name',
            'price' => 6900,
            'quantity' => 1,
            'description' => null,
        ]);
    }

    /** @test */
    public function can_delete_shopping_cart_item(): void
    {
        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = factory(ShoppingCartItem::class)->create();

        /** @var ShoppingCartItemRepository $shoppingCartItemRepository */
        $shoppingCartItemRepository = app(ShoppingCartItemRepository::class);

        $result = $shoppingCartItemRepository->delete($shoppingCartItem);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('shopping_cart_items', ['id' => $shoppingCartItem->id]);
    }

    /** @test */
    public function can_increase_quantity_to_shopping_cart_item(): void
    {
        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = factory(ShoppingCartItem::class)->create([
            'name' => 'Testing item name',
            'price' => 6900,
            'quantity' => 1,
            'description' => null,
        ]);

        /** @var ShoppingCartItemRepository $shoppingCartItemRepository */
        $shoppingCartItemRepository = app(ShoppingCartItemRepository::class);

        $result = $shoppingCartItemRepository->increaseQuantity($shoppingCartItem);

        $this->assertTrue($result);
        $this->assertDatabaseHas('shopping_cart_items', [
            'id' => $shoppingCartItem->id,
            'price' => 6900,
            'quantity' => 2,
        ]);
    }

    /** @test */
    public function can_set_quantity_to_shopping_cart_item(): void
    {
        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = factory(ShoppingCartItem::class)->create([
            'name' => 'Testing item name',
            'price' => 6900,
            'quantity' => 1,
            'description' => null,
        ]);

        /** @var ShoppingCartItemRepository $shoppingCartItemRepository */
        $shoppingCartItemRepository = app(ShoppingCartItemRepository::class);

        $result = $shoppingCartItemRepository->setQuantity($shoppingCartItem, 10);

        $this->assertTrue($result);
        $this->assertDatabaseHas('shopping_cart_items', [
            'id' => $shoppingCartItem->id,
            'price' => 6900,
            'quantity' => 10,
        ]);
    }

    /** @test */
    public function can_decrease_quantity_to_shopping_cart_item(): void
    {
        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = factory(ShoppingCartItem::class)->create([
            'name' => 'Testing item name',
            'price' => 6900,
            'quantity' => 2,
            'description' => null,
        ]);

        /** @var ShoppingCartItemRepository $shoppingCartItemRepository */
        $shoppingCartItemRepository = app(ShoppingCartItemRepository::class);

        $result = $shoppingCartItemRepository->decreaseQuantity($shoppingCartItem);

        $this->assertTrue($result);
        $this->assertDatabaseHas('shopping_cart_items', [
            'id' => $shoppingCartItem->id,
            'price' => 6900,
            'quantity' => 1,
        ]);
    }
}
