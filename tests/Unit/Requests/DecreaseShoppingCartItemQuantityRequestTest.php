<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Requests;


use Gausejakub\ShoppingCart\Facades\ShoppingCartItemFacade;
use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Requests\DecreaseShoppingCartItemQuantityRequest;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;

final class DecreaseShoppingCartItemQuantityRequestTest extends UnitTestCase
{
    /** @test */
    public function authorize_method_returns_true(): void
    {
        $request = new DecreaseShoppingCartItemQuantityRequest();

        $result = $request->authorize();

        $this->assertTrue($result);
    }

    /** @test */
    public function rules_method_returns_valid_array(): void
    {
        $request = new DecreaseShoppingCartItemQuantityRequest();

        $rules = $request->rules();

        $this->assertEquals([], $rules);
    }

    /** @test */
    public function handle_method_returns_true_when_decrease_quantity_method_returns_true(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();
        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = factory(ShoppingCartItem::class)->create(['shopping_cart_id' => $shoppingCart->id]);

        ShoppingCartItemFacade::shouldReceive('decreaseQuantity')
            ->andReturn(true)
            ->once();

        /** @var DecreaseShoppingCartItemQuantityRequest $request */
        $request = \Mockery::mock(DecreaseShoppingCartItemQuantityRequest::class)->makePartial();
        $request->shouldReceive('route')
            ->with('shoppingCart')
            ->andReturn($shoppingCart->id)
            ->once();

        $request->shouldReceive('route')
            ->with('shoppingCartItem')
            ->andReturn($shoppingCartItem->id)
            ->once();

        $result = $request->handle();

        $this->assertTrue($result);
    }

    /** @test */
    public function handle_method_returns_false_when_decrease_quantity_method_returns_false(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();
        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = factory(ShoppingCartItem::class)->create(['shopping_cart_id' => $shoppingCart->id]);

        ShoppingCartItemFacade::shouldReceive('decreaseQuantity')
            ->andReturn(false)
            ->once();

        /** @var DecreaseShoppingCartItemQuantityRequest $request */
        $request = \Mockery::mock(DecreaseShoppingCartItemQuantityRequest::class)->makePartial();
        $request->shouldReceive('route')
            ->with('shoppingCart')
            ->andReturn($shoppingCart->id)
            ->once();

        $request->shouldReceive('route')
            ->with('shoppingCartItem')
            ->andReturn($shoppingCartItem->id)
            ->once();

        $result = $request->handle();

        $this->assertFalse($result);
    }

    /** @test */
    public function handle_method_returns_false_when_exception_is_not_thrown(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();
        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = factory(ShoppingCartItem::class)->create(['shopping_cart_id' => $shoppingCart->id]);

        ShoppingCartItemFacade::shouldReceive('decreaseQuantity')
            ->andThrow(new \Exception())
            ->once();

        /** @var DecreaseShoppingCartItemQuantityRequest $request */
        $request = \Mockery::mock(DecreaseShoppingCartItemQuantityRequest::class)->makePartial();
        $request->shouldReceive('route')
            ->with('shoppingCart')
            ->andReturn($shoppingCart->id)
            ->once();

        $request->shouldReceive('route')
            ->with('shoppingCartItem')
            ->andReturn($shoppingCartItem->id)
            ->once();

        $result = $request->handle();

        $this->assertFalse($result);
    }
}
