<?php


namespace Gausejakub\ShoppingCart\Requests;


use Gausejakub\ShoppingCart\Facades\ShoppingCartItemFacade;
use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IncreaseShoppingCartItemQuantityRequest
 * @package Gausejakub\ShoppingCart
 */
class IncreaseShoppingCartItemQuantityRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
        ];
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        /** @var ShoppingCart $shoppingCart */
        $shoppingCart = ShoppingCart::findOrFail($this->route('shoppingCart'));

        /** @var ShoppingCartItem $shoppingCartItem */
        $shoppingCartItem = $shoppingCart->items()
            ->where('id', $this->route('shoppingCartItem'))
            ->firstOrFail();

        try {
            return ShoppingCartItemFacade::increaseQuantity($shoppingCartItem);
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @return ShoppingCart|null
     */
    public function responseData()
    {

    }
}
