<?php declare(strict_types=1);


namespace Gausejakub\ShoppingCart\Tests\Unit\Http;


use Gausejakub\ShoppingCart\Http\ShoppingCartItemsController;
use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Requests\DeleteShoppingCartItemRequest;
use Gausejakub\ShoppingCart\Requests\GetShoppingCartItemRequest;
use Gausejakub\ShoppingCart\Requests\GetShoppingCartItemsRequest;
use Gausejakub\ShoppingCart\Requests\StoreShoppingCartItemRequest;
use Gausejakub\ShoppingCart\Requests\UpdateShoppingCartItemRequest;
use Gausejakub\ShoppingCart\Tests\Unit\UnitTestCase;
use Illuminate\Http\JsonResponse;

final class ShoppingCartItemsControllerTest extends UnitTestCase
{
    /** @test */
    public function index_method_uses_get_shopping_cart_items_request(): void
    {
        $getShoppingCartItemsRequest = \Mockery::mock(GetShoppingCartItemsRequest::class);
        $getShoppingCartItemsRequest->shouldReceive('handle')
            ->with()
            ->andReturn(true)
            ->once();
        $getShoppingCartItemsRequest->shouldReceive('responseData')
            ->with()
            ->andReturn(collect([]))
            ->once();

        $shoppingCartItemsController = new ShoppingCartItemsController();

        $response = $shoppingCartItemsController->index($getShoppingCartItemsRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode([
            'success' => true,
            'data' => collect([]),
        ]), $response->getContent());
    }

    /** @test */
    public function show_method_uses_get_shopping_cart_item_request(): void
    {
        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = factory(ShoppingCartItem::class)->create();
        $getShoppingCartItemRequest = \Mockery::mock(GetShoppingCartItemRequest::class);
        $getShoppingCartItemRequest->shouldReceive('handle')
            ->with()
            ->andReturn(true)
            ->once();
        $getShoppingCartItemRequest->shouldReceive('responseData')
            ->with()
            ->andReturn($shoppingCartItem)
            ->once();

        $shoppingCartItemsController = new ShoppingCartItemsController();

        $response = $shoppingCartItemsController->show($getShoppingCartItemRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode([
            'success' => true,
            'data' => $shoppingCartItem,
        ]), $response->getContent());
    }

    /** @test */
    public function store_method_uses_store_shopping_cart_item_request(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();
        $storeShoppingCartItemRequest = \Mockery::mock(StoreShoppingCartItemRequest::class);
        $storeShoppingCartItemRequest->shouldReceive('handle')
            ->with()
            ->andReturn(true)
            ->once();
        $storeShoppingCartItemRequest->shouldReceive('responseData')
            ->with()
            ->andReturn($shoppingCart)
            ->once();

        $shoppingCartItemsController = new ShoppingCartItemsController();

        $response = $shoppingCartItemsController->store($storeShoppingCartItemRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode([
            'success' => true,
            'data' => $shoppingCart
        ]), $response->getContent());
    }

    /** @test */
    public function update_method_uses_update_shopping_cart_item_request(): void
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = factory(ShoppingCart::class)->create();
        $updateShoppingCartItemRequest = \Mockery::mock(UpdateShoppingCartItemRequest::class);
        $updateShoppingCartItemRequest->shouldReceive('handle')
            ->with()
            ->andReturn(true)
            ->once();
        $updateShoppingCartItemRequest->shouldReceive('responseData')
            ->with()
            ->andReturn($shoppingCart)
            ->once();

        $shoppingCartItemsController = new ShoppingCartItemsController();

        $response = $shoppingCartItemsController->update($updateShoppingCartItemRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode([
            'success' => true,
            'data' => $shoppingCart
        ]), $response->getContent());
    }

    /** @test */
    public function destroy_method_uses_delete_shopping_cart_item_request(): void
    {
        $deleteShoppingCartItemRequest = \Mockery::mock(DeleteShoppingCartItemRequest::class);
        $deleteShoppingCartItemRequest->shouldReceive('handle')
            ->with()
            ->andReturn(true)
            ->once();

        $shoppingCartItemsController = new ShoppingCartItemsController();

        $response = $shoppingCartItemsController->destroy($deleteShoppingCartItemRequest);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(json_encode([
            'success' => true,
            'data' => null,
        ]), $response->getContent());
    }
}
