<?php

namespace Gausejakub\ShoppingCart\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * Class ShoppingCart
 * @package Gausejakub\ShoppingCart
 *
 * @property string $id
 * @property string $owner_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection $items
 * @method bool update(array $attributes = [])
 */
class ShoppingCart extends Model
{
    /**
     * @var string
     */
    protected $primaryKey = 'id'; // or null

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $table = 'shopping_carts';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'owner_id',
        'created_at',
        'updated_at',
    ];

    /**
     * Create ShoppingCart instance and save it to DB
     *
     * @param array $attributes
     * @return ShoppingCart
     */
    public static function create(array $attributes = []): self
    {
        $attributes = array_merge($attributes, [
            'id' => Str::uuid(),
        ]);

        return static::query()->create($attributes);
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(ShoppingCartItem::class);
    }
}
