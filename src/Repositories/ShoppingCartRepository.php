<?php


namespace Gausejakub\ShoppingCart\Repositories;


use Gausejakub\ShoppingCart\Models\ShoppingCart;

class ShoppingCartRepository
{
    /**
     * Create Shopping Cart
     *
     * @param string $ownerId
     * @return ShoppingCart
     */
    public function create(string $ownerId): ShoppingCart
    {
        return ShoppingCart::create([
            'owner_id' => $ownerId,
        ]);
    }
}
