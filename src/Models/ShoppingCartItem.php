<?php


namespace Gausejakub\ShoppingCart\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ShoppingCartItem
 * @package Gausejakub\ShoppingCart
 *
 * @property-read int $id
 * @property string $name
 * @property int $price
 * @property int $quantity
 * @property string|null $description
 * @property string $shopping_cart_id
 * @property ShoppingCart $shoppingCart
 * @property-read int $totalPrice
 */
class ShoppingCartItem extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @var string
     */
    protected $table = 'shopping_cart_items';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
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

    /**
     * Price of item count to one unit
     *
     * @return int
     */
    public function getTotalPriceAttribute(): int
    {
        return (int)($this->price * $this->quantity);
    }
}
