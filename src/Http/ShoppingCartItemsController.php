<?php


namespace Gausejakub\ShoppingCart\Http;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Requests\DeleteShoppingCartItemRequest;
use Gausejakub\ShoppingCart\Requests\GetShoppingCartItemRequest;
use Gausejakub\ShoppingCart\Requests\GetShoppingCartItemsRequest;
use Gausejakub\ShoppingCart\Requests\StoreShoppingCartItemRequest;
use Gausejakub\ShoppingCart\Requests\StoreShoppingCartRequest;
use Gausejakub\ShoppingCart\Requests\UpdateShoppingCartItemRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ShoppingCartItemsController extends Controller
{
    /**
     * @param GetShoppingCartItemsRequest $request
     * @return JsonResponse
     */
    public function index(GetShoppingCartItemsRequest $request): JsonResponse
    {
        $result = $request->handle();
        $data = $request->responseData();

        return response()->json([
            'success' => $result,
            'data' => $data,
        ]);
    }

    /**
     * @param GetShoppingCartItemRequest $request
     * @return JsonResponse
     */
    public function show(GetShoppingCartItemRequest $request): JsonResponse
    {
//        /** @var ShoppingCart $shoppingCart */
//        $shoppingCart = ShoppingCart::findOrFail($request->route('shoppingCart'));
//        $shoppingCartItem = $shoppingCart->items()->findOrFail($request->route('shoppingCartItem'));
//        abort_if($shoppingCart->id !== $shoppingCartItem->shopping_cart_id, 404);

        $result = $request->handle();
        $data = $request->responseData();

        return response()->json([
            'success' => $result,
            'data' => $data,
        ]);
    }

    /**
     * @param StoreShoppingCartItemRequest $request
     * @return JsonResponse
     */
    public function store(StoreShoppingCartItemRequest $request): JsonResponse
    {
        $result = $request->handle();
        $data = $request->responseData();

        return response()->json([
            'success' => $result,
            'data' => $data,
        ]);
    }

    /**
     * @param UpdateShoppingCartItemRequest $request
     * @return JsonResponse
     */
    public function update(UpdateShoppingCartItemRequest $request): JsonResponse
    {
//        /** @var ShoppingCart $shoppingCart */
//        $shoppingCart = ShoppingCart::findOrFail($request->route('shoppingCart'));
//        $shoppingCartItem = $shoppingCart->items()->findOrFail($request->route('shoppingCartItem'));
//        abort_if($shoppingCart->id !== $shoppingCartItem->shopping_cart_id, 404);

        $result = $request->handle();
        $data = $request->responseData();

        return response()->json([
            'success' => $result,
            'data' => $data,
        ]);
    }

    /**
     * @param DeleteShoppingCartItemRequest $request
     * @return JsonResponse
     */
    public function destroy(DeleteShoppingCartItemRequest $request): JsonResponse
    {
//        /** @var ShoppingCart $shoppingCart */
//        $shoppingCart = ShoppingCart::findOrFail($request->route('shoppingCart'));
//        $shoppingCartItem = $shoppingCart->items()->findOrFail($request->route('shoppingCartItem'));
//        abort_if($shoppingCart->id !== $shoppingCartItem->shopping_cart_id, 404);

        $result = $request->handle();

        return response()->json([
            'success' => $result,
            'data' => null,
        ]);
    }
}
