<?php


namespace Gausejakub\ShoppingCart\Http;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Requests\StoreShoppingCartRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ShoppingCartsController extends Controller
{
    /**
     * @param Request $request
     * @param ShoppingCart $shoppingCart
     * @return JsonResponse
     */
    public function show(Request $request, ShoppingCart $shoppingCart): JsonResponse
    {
        return response()->json([
            'data' => $shoppingCart
        ]);
    }

    /**
     * @param StoreShoppingCartRequest $request
     * @return JsonResponse
     */
    public function store(StoreShoppingCartRequest $request): JsonResponse
    {
        $result = $request->handle();
        $data = $request->responseData();

        return response()->json([
            'success' => $result,
            'data' => $data,
        ]);
    }

    /**
     * @param Request $request
     * @param ShoppingCart $shoppingCart
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Request $request, ShoppingCart $shoppingCart): JsonResponse
    {
        return response()->json([
            'success' => $shoppingCart->delete()
        ]);
    }
}
