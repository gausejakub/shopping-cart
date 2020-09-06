<?php


namespace Gausejakub\ShoppingCart\Requests;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GetShoppingCartItemRequest
 * @package Gausejakub\ShoppingCart
 */
class GetShoppingCartItemRequest extends FormRequest
{
    /**
     * @var ShoppingCartItem
     */
    protected $shoppingCartItem;

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

        /** @var ShoppingCartItem|null $shoppingCart */
        $shoppingCartItem = $shoppingCart->items()
            ->findOrFail($this->route('shoppingCartItem'));

        try {
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * @return ShoppingCartItem|null
     */
    public function responseData()
    {
        return $this->shoppingCartItem;
    }
}
