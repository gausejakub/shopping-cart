<?php


namespace Gausejakub\ShoppingCart\Requests;


use Gausejakub\ShoppingCart\Facades\ShoppingCartItemFacade;
use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateShoppingCartItemQuantityRequest
 * @package Gausejakub\ShoppingCart
 *
 * @property int $quantity
 */
class UpdateShoppingCartItemQuantityRequest extends FormRequest
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
            'quantity' => 'required|int|min:1',
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
            return ShoppingCartItemFacade::setQuantity($shoppingCartItem, $this->quantity);
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
