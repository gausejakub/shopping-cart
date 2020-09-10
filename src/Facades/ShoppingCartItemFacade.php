<?php

namespace Gausejakub\ShoppingCart\Facades;

use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;
use Illuminate\Support\Facades\Facade;

/**
 * Class ShoppingCartItemFacade
 * @package Gausejakub\ShoppingCart
 * @see \Gausejakub\ShoppingCart\Repositories\ShoppingCartItemRepository;
 *
 * @method static ShoppingCartItem create(ShoppingCart $shoppingCart, string $name, int $price, int $quantity, ?string $description)
 * @method static bool delete(ShoppingCartItem $shoppingCartItem)
 * @method static bool setQuantity(ShoppingCartItem $shoppingCartItem, int $quantity)
 * @method static bool increaseQuantity(ShoppingCartItem $shoppingCartItem)
 * @method static bool decreaseQuantity(ShoppingCartItem $shoppingCartItem)
 */
class ShoppingCartItemFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopping-cart-item';
    }
}
