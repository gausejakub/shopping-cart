<?php


namespace Gausejakub\ShoppingCart\Tests;


use Gausejakub\ShoppingCart\ShoppingCartServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [ShoppingCartServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_shopping_carts_table.php';
        include_once __DIR__ . '/../database/migrations/create_shopping_cart_items_table.php';

        (new \CreateShoppingCartsTable)->up();
        (new \CreateShoppingCartItemsTable)->up();
    }
}
