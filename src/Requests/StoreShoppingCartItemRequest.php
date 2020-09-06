<?php


namespace Gausejakub\ShoppingCart\Requests;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreShoppingCartItemRequest
 * @package Gausejakub\ShoppingCart
 */
class StoreShoppingCartItemRequest extends FormRequest
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
