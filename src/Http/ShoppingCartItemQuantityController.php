<?php


namespace Gausejakub\ShoppingCart\Http;


use Gausejakub\ShoppingCart\Requests\DecreaseShoppingCartItemQuantityRequest;
use Gausejakub\ShoppingCart\Requests\IncreaseShoppingCartItemQuantityRequest;
use Gausejakub\ShoppingCart\Requests\UpdateShoppingCartItemQuantityRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ShoppingCartItemQuantityController extends Controller
{
    /**
     * @param UpdateShoppingCartItemQuantityRequest $request
     * @return JsonResponse
     */
    public function update(UpdateShoppingCartItemQuantityRequest $request): JsonResponse
    {
        $result = $request->handle();
        return response()->json([
            'success' => $result,
            'data' => $request->responseData(),
        ]);
    }

    /**
     * @param IncreaseShoppingCartItemQuantityRequest $request
     * @return JsonResponse
     */
    public function increase(IncreaseShoppingCartItemQuantityRequest $request): JsonResponse
    {
        $result = $request->handle();
        return response()->json([
            'success' => $result,
            'data' => $request->responseData(),
        ]);
    }

    /**
     * @param DecreaseShoppingCartItemQuantityRequest $request
     * @return JsonResponse
     */
    public function decrease(DecreaseShoppingCartItemQuantityRequest $request): JsonResponse
    {
        $result = $request->handle();
        return response()->json([
            'success' => $result,
            'data' => $request->responseData(),
        ]);
    }
}
