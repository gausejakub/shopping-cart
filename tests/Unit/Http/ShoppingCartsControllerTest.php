<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Http;


use Gausejakub\ShoppingCart\Http\ShoppingCartsController;
use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Requests\StoreShoppingCartRequest;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;
use Illuminate\Http\JsonResponse;

final class ShoppingCartControllerTest extends UnitTestCase
{
    /** @test */
    public function store_method_uses_store_shopping_cart_request(): void
    {
        $shoppingCartsController = new ShoppingCartsController();

        $storeShoppingCartRequest = \Mockery::mock(StoreShoppingCartRequest::class);
        $storeShoppingCartRequest->shouldReceive('handle')
            ->with()
            ->andReturn(true)
            ->once();
        $storeShoppingCartRequest->shouldReceive('responseData')
            ->with()
            ->andReturn(factory(ShoppingCart::class)->create())
            ->once();

        $shoppingCartsController->store($storeShoppingCartRequest);
    }

    /** @test */
    public function store_methods_returns_valid_success_json_response(): void
    {
        $shoppingCart = factory(ShoppingCart::class)->create();
        $shoppingCartsController = new ShoppingCartsController();

        $storeShoppingCartRequest = \Mockery::mock(StoreShoppingCartRequest::class);
        $storeShoppingCartRequest->shouldReceive('handle')
            ->with()
            ->andReturn(true)
            ->once();
        $storeShoppingCartRequest->shouldReceive('responseData')
            ->with()
            ->andReturn($shoppingCart)
            ->once();

        $response = $shoppingCartsController->store($storeShoppingCartRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode([
            'success' => true,
            'data' => $shoppingCart,
        ]), $response->getContent());
    }

    /** @test */
    public function store_methods_returns_valid_failed_json_response(): void
    {
        $shoppingCartsController = new ShoppingCartsController();

        $storeShoppingCartRequest = \Mockery::mock(StoreShoppingCartRequest::class);
        $storeShoppingCartRequest->shouldReceive('handle')
            ->with()
            ->andReturn(false)
            ->once();
        $storeShoppingCartRequest->shouldReceive('responseData')
            ->with()
            ->andReturn(null)
            ->once();

        $response = $shoppingCartsController->store($storeShoppingCartRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode([
            'success' => false,
            'data' => null,
        ]), $response->getContent());
    }
}
