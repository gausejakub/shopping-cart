<?php

namespace Gausejakub\ShoppingCart\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class ShoppingCartItemFacade
 * @package Gausejakub\ShoppingCart
 * @see \Gausejakub\ShoppingCart\Repositories\ShoppingCartItemRepository;
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
