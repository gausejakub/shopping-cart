<?php


namespace Gausejakub\ShoppingCart\Repositories;


use Gausejakub\ShoppingCart\Models\ShoppingCart;
use Gausejakub\ShoppingCart\Models\ShoppingCartItem;

class ShoppingCartItemRepository
{
    /**
     * Create Shopping Cart Item for Shopping Cart with given attributes
     *
     * @param ShoppingCart $shoppingCart
     * @param string $name
     * @param int $price
     * @param int $quantity
     * @param string|null $description
     * @return ShoppingCartItem
     */
    public function create(ShoppingCart $shoppingCart, string $name, int $price, int $quantity, ?string $description = null): ShoppingCartItem
    {
        return ShoppingCartItem::create([
            'shopping_cart_id' => $shoppingCart->id,
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'description' => $description,
        ]);
    }

    /**
     * Delete Shopping Cart Item
     *
     * @param ShoppingCartItem $shoppingCartItem
     * @return bool
     * @throws \Exception
     */
    public function delete(ShoppingCartItem $shoppingCartItem): bool
    {
        try {
            return $shoppingCartItem->delete();
        } catch (\Exception $exception) {
            return false;
        }
    }

    /**
     * Set quantity of Shopping Cart Item (automatically counts price from it)
     *
     * @param ShoppingCartItem $shoppingCartItem
     * @param int $quantity
     * @return bool
     */
    public function setQuantity(ShoppingCartItem $shoppingCartItem, int $quantity): bool
    {
        return $shoppingCartItem->update([
            'quantity' => $quantity
        ]);
    }

    /**
     * Increase quantity by one to Shopping Cart Item
     *
     * @param ShoppingCartItem $shoppingCartItem
     * @return bool
     */
    public function increaseQuantity(ShoppingCartItem $shoppingCartItem): bool
    {
        return $this->setQuantity($shoppingCartItem, $shoppingCartItem->quantity + 1);
    }

    /**
     * Decrease quantity by one to Shopping Cart Item
     *
     * @param ShoppingCartItem $shoppingCartItem
     * @return bool
     */
    public function decreaseQuantity(ShoppingCartItem $shoppingCartItem): bool
    {
        if ($shoppingCartItem->quantity === 1) {
            return false;
        }
        return $this->setQuantity($shoppingCartItem, $shoppingCartItem->quantity - 1);
    }
}
