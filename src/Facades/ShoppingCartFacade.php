<?php

namespace Gausejakub\ShoppingCart\Facades;

use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Illuminate\Support\Facades\Facade;

/**
 * Class ShoppingCartItemFacade
 * @package Gausejakub\ShoppingCart
 * @see \Gausejakub\ShoppingCart\Repositories\ShoppingCartRepository;
 *
 * @method static ShoppingCart create(string $ownerId)
 */
class ShoppingCartFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'shopping-cart';
    }
}
