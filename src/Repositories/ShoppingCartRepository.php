<?php


namespace Gausejakub\ShoppingCart\Repositories;


use Gausejakub\ShoppingCart\Models\ShoppingCart;

class ShoppingCartRepository
{
    /**
     * Find Shopping Cart by id
     *
     * @param $id
     * @return ShoppingCart|null
     */
    public function findById($id)
    {
        return ShoppingCart::where('id', $id)->first();
    }

    /**
     * Find Shopping Cart by owner_id
     *
     * @param $ownerId
     * @return ShoppingCart|null
     */
    public function findByOwnerId($ownerId)
    {
        return ShoppingCart::where('owner_id', $ownerId)->first();
    }

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

    /**
     * Delete Shopping Cart
     *
     * @param ShoppingCart $shoppingCart
     * @return bool
     * @throws \Exception
     */
    public function delete(ShoppingCart $shoppingCart): bool
    {
        return $shoppingCart->delete();
    }
}
