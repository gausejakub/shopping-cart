<?php


namespace Gausejakub\ShoppingCart\Requests;


use Gausejakub\ShoppingCart\Facades\ShoppingCartFacade;
use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreShoppingCartRequest
 * @package Gausejakub\ShoppingCart\Requests
 *
 * @property string $owner_id
 */
class StoreShoppingCartRequest extends FormRequest
{
    /**
     * @var ShoppingCart|null
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
            'owner_id' => 'required|string|min:1|max:255',
        ]; // TODO: Create shopping cart owner id rule
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        try {
            $this->shoppingCart = ShoppingCartFacade::create($this->owner_id);
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
