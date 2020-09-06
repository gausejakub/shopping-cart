<?php


namespace Gausejakub\ShoppingCart\Requests;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateShoppingCartItemRequest
 * @package Gausejakub\ShoppingCart
 */
class UpdateShoppingCartItemRequest extends FormRequest
{
    /**
     * @var ShoppingCart
     */
    protected $shoppingCart;

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
     * @return ShoppingCart|null
     */
    public function responseData()
    {
        return $this->shoppingCart;
    }
}
