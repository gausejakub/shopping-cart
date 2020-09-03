<?php


namespace Gausejakub\ShoppingCart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ShoppingCartItem
 * @package Gausejakub\ShoppingCart
 *
 * @property string $name
 * @property int $price
 * @property int $quantity
 * @property string|null $description
 * @property string $shopping_cart_id
 * @property ShoppingCart $shoppingCart
 */
class ShoppingCartItem extends Model
{
    /**
     * @var string
     */
    protected $table = 'shopping_cart_items';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
        'quantity',
        'description',
        'shopping_cart_id',
    ];

    /**
     * @return BelongsTo
     */
    public function shoppingCart(): BelongsTo
    {
        return $this->belongsTo(ShoppingCart::class);
    }
}
