<?php


namespace Gausejakub\ShoppingCart\Requests;


use Gausejakub\ShoppingCart\Facades\ShoppingCartItemFacade;
use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreShoppingCartItemRequest
 * @package Gausejakub\ShoppingCart
 *
 * @property string $name
 * @property int $price
 * @property int $quantity
 * @property string|null $description
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
            'name' => 'required|string|min:1|max:255',
            'price' => 'required|int',
            'quantity' => 'required|int|min:1',
            'description' => 'nullable|string|max:5000',
        ];
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        try {
            $shoppingCart = ShoppingCart::findOrFail($this->route('shoppingCart'));

            ShoppingCartItemFacade::create(
                $shoppingCart,
                $this->name,
                $this->price,
                $this->quantity,
                $this->description
            );
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
