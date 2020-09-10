<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Requests;


use Gausejakub\ShoppingCart\Facades\ShoppingCartItemFacade;
use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Requests\UpdateShoppingCartItemQuantityRequest;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;

final class UpdateShoppingCartItemQuantityRequestTest extends UnitTestCase
{
    /** @test */
    public function authorize_method_returns_true(): void
    {
        $request = new UpdateShoppingCartItemQuantityRequest();

        $result = $request->authorize();

        $this->assertTrue($result);
    }

    /** @test */
    public function rules_method_returns_valid_array(): void
    {
        $request = new UpdateShoppingCartItemQuantityRequest();

        $rules = $request->rules();

        $this->assertEquals([
            'quantity' => 'required|int|min:1',
        ], $rules);
    }

    /** @test */
    public function handle_method_returns_true_when_set_quantity_method_returns_true(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();
        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = factory(ShoppingCartItem::class)->create(['shopping_cart_id' => $shoppingCart->id]);

        ShoppingCartItemFacade::shouldReceive('setQuantity')
            ->with(ShoppingCartItem::class, 5)
            ->andReturn(true)
            ->once();

        /** @var UpdateShoppingCartItemQuantityRequest $request */
        $request = \Mockery::mock(UpdateShoppingCartItemQuantityRequest::class)->makePartial();
        $request->shouldReceive('route')
            ->with('shoppingCart')
            ->andReturn($shoppingCart->id)
            ->once();

        $request->shouldReceive('route')
            ->with('shoppingCartItem')
            ->andReturn($shoppingCartItem->id)
            ->once();
        $request->quantity = 5;

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

        ShoppingCartItemFacade::shouldReceive('setQuantity')
            ->with(ShoppingCartItem::class, 1)
            ->andReturn(false)
            ->once();

        /** @var UpdateShoppingCartItemQuantityRequest $request */
        $request = \Mockery::mock(UpdateShoppingCartItemQuantityRequest::class)->makePartial();
        $request->shouldReceive('route')
            ->with('shoppingCart')
            ->andReturn($shoppingCart->id)
            ->once();

        $request->shouldReceive('route')
            ->with('shoppingCartItem')
            ->andReturn($shoppingCartItem->id)
            ->once();

        $request->quantity = 1;

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

        ShoppingCartItemFacade::shouldReceive('setQuantity')
            ->andThrow(new \Exception())
            ->once();

        /** @var UpdateShoppingCartItemQuantityRequest $request */
        $request = \Mockery::mock(UpdateShoppingCartItemQuantityRequest::class)->makePartial();
        $request->shouldReceive('route')
            ->with('shoppingCart')
            ->andReturn($shoppingCart->id)
            ->once();

        $request->shouldReceive('route')
            ->with('shoppingCartItem')
            ->andReturn($shoppingCartItem->id)
            ->once();
        $request->quantity = 5;

        $result = $request->handle();

        $this->assertFalse($result);
    }
}
