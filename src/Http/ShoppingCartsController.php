<?php


namespace Gausejakub\ShoppingCart\Http;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $shoppingCart = ShoppingCart::create([
            'owner_id' => $request->owner_id,
        ]);

        return response()->json([
            'success' => true,
            'data' => $shoppingCart,
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
