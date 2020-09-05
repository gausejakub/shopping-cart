<?php


namespace Gausejakub\ShoppingCart\Http;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Gausejakub\ShoppingCart\Requests\StoreShoppingCartRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ShoppingCartItemsController extends Controller
{
    /**
     * @param Request $request
     * @param ShoppingCart $shoppingCart
     * @return JsonResponse
     */
    public function index(Request $request, ShoppingCart $shoppingCart): JsonResponse
    {
        return response()->json([]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::findOrFail($request->route('shoppingCart'));
        $shoppingCartItem = $shoppingCart->items()->findOrFail($request->route('shoppingCartItem'));
        abort_if($shoppingCart->id !== $shoppingCartItem->shopping_cart_id, 404);

        return response()->json([]);
    }

    /**
     * @param Request $request
     * @param ShoppingCart $shoppingCart
     * @return JsonResponse
     */
    public function store(Request $request, ShoppingCart $shoppingCart): JsonResponse
    {
        return response()->json([]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request): JsonResponse
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::findOrFail($request->route('shoppingCart'));
        $shoppingCartItem = $shoppingCart->items()->findOrFail($request->route('shoppingCartItem'));
        abort_if($shoppingCart->id !== $shoppingCartItem->shopping_cart_id, 404);

        return response()->json([]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::findOrFail($request->route('shoppingCart'));
        $shoppingCartItem = $shoppingCart->items()->findOrFail($request->route('shoppingCartItem'));
        abort_if($shoppingCart->id !== $shoppingCartItem->shopping_cart_id, 404);

        return response()->json([]);
    }
}
