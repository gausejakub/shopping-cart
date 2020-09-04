<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Requests;


use Gausejakub\ShoppingCart\Facades\ShoppingCartFacade;
use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Requests\StoreShoppingCartRequest;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;

/**
 * Class StoreShoppingCartRequestTest
 * @package Gausejakub\ShoppingCart
 * @see StoreShoppingCartRequest
 */
final class StoreShoppingCartRequestTest extends UnitTestCase
{
    /** @test */
    public function authorize_returns_true(): void
    {
        $request = new StoreShoppingCartRequest();

        $this->assertTrue($request->authorize());
    }

    /** @test */
    public function rules_are_valid(): void
    {
        $request = new StoreShoppingCartRequest();

        $this->assertEquals([
            'owner_id' => 'required|string|min:1|max:255',
        ], $request->rules());
    }

    /** @test */
    public function handle_creates_shopping_cart(): void
    {
        $request = new StoreShoppingCartRequest();

        $request->merge([
            'owner_id' => 'testing_owner_id',
        ]);

        ShoppingCartFacade::shouldReceive('create')
            ->with('testing_owner_id')
            ->andReturn(factory(ShoppingCart::class)->create())
            ->once();

        $request->handle();
    }

    /** @test */
    public function handle_return_true_when_shopping_cart_is_created_without_exception(): void
    {
        $request = new StoreShoppingCartRequest();

        $request->merge([
            'owner_id' => 'testing_owner_id',
        ]);

        ShoppingCartFacade::shouldReceive('create')
            ->with('testing_owner_id')
            ->andReturn(factory(ShoppingCart::class)->create())
            ->once();

        $this->assertTrue($request->handle());
    }

    /** @test */
    public function handle_returns_false_when_create_shopping_cart_method_throws_exception(): void
    {
        $request = new StoreShoppingCartRequest();

        $request->merge([
            'owner_id' => 'testing_owner_id',
        ]);

        ShoppingCartFacade::shouldReceive('create')
            ->with('testing_owner_id')
            ->andThrow(new \Exception())
            ->once();

        $this->assertFalse($request->handle());
    }
}
