<?php


namespace Gausejakub\ShoppingCart\Requests;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Collection;

/**
 * Class GetShoppingCartItemsRequest
 * @package Gausejakub\ShoppingCart
 */
class GetShoppingCartItemsRequest extends FormRequest
{
    /**
     * @var Collection
     */
    protected $shoppingCartItems;

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
     * @return Collection
     */
    public function responseData()
    {
        return $this->shoppingCartItems;
    }
}
