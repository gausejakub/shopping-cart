<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Requests;


use Gausejakub\ShoppingCart\Facades\ShoppingCartItemFacade;
use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Requests\StoreShoppingCartItemRequest;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;

/**
 * Class StoreShoppingCartItemRequestTest
 * @package Gausejakub\ShoppingCart
 * @see StoreShoppingCartRequest
 */
final class StoreShoppingCartItemRequestTest extends UnitTestCase
{
    /** @test */
    public function authorize_returns_true(): void
    {
        $request = new StoreShoppingCartItemRequest();

        $this->assertTrue($request->authorize());
    }

    /** @test */
    public function rules_are_valid(): void
    {
        $request = new StoreShoppingCartItemRequest();

        $this->assertEquals([
            'name' => 'required|string|min:1|max:255',
            'price' => 'required|int',
            'quantity' => 'required|int|min:1',
            'description' => 'nullable|string|max:5000',
        ], $request->rules());
    }

    /** @test */
    public function handle_creates_shopping_cart_item(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();
        /** @var StoreShoppingCartItemRequest $request */
        $request = \Mockery::mock(StoreShoppingCartItemRequest::class)->makePartial();

        $request->shouldReceive('route')
            ->with('shoppingCart')
            ->andReturn($shoppingCart->id)
            ->once();
        $request->name = 'My product';
        $request->price = 6900;
        $request->quantity = 1;
        $request->description = null;

        ShoppingCartItemFacade::shouldReceive('create')
            ->with(
                ShoppingCart::class,
                'My product',
                6900,
                1,
                null
            )
            ->andReturn(factory(ShoppingCartItem::class)->create())
            ->once();

        $request->handle();
    }

    /** @test */
    public function handle_return_true_when_shopping_cart_item_is_created_without_exception(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();
        /** @var StoreShoppingCartItemRequest $request */
        $request = \Mockery::mock(StoreShoppingCartItemRequest::class)->makePartial();

        $request->shouldReceive('route')
            ->with('shoppingCart')
            ->andReturn($shoppingCart->id)
            ->once();
        $request->name = 'My product';
        $request->price = 6900;
        $request->quantity = 1;
        $request->description = null;

        ShoppingCartItemFacade::shouldReceive('create')
            ->with(
                ShoppingCart::class,
                'My product',
                6900,
                1,
                null
            )
            ->andReturn(factory(ShoppingCartItem::class)->create())
            ->once();

        $this->assertTrue($request->handle());
    }

    /** @test */
    public function handle_returns_false_when_create_shopping_cart_method_throws_exception(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();
        /** @var StoreShoppingCartItemRequest $request */
        $request = \Mockery::mock(StoreShoppingCartItemRequest::class)->makePartial();

        $request->shouldReceive('route')
            ->with('shoppingCart')
            ->andReturn($shoppingCart->id)
            ->once();
        $request->name = 'My product';
        $request->price = 6900;
        $request->quantity = 1;
        $request->description = null;

        ShoppingCartItemFacade::shouldReceive('create')
            ->andThrow(new \Exception())
            ->once();

        $this->assertFalse($request->handle());
    }
}
