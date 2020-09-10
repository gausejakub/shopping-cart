<?php

namespace Gausejakub\ShoppingCart;

use Gausejakub\ShoppingCart\Repositories\ShoppingCartItemRepository;
use Gausejakub\ShoppingCart\Repositories\ShoppingCartRepository;
use Illuminate\Support\ServiceProvider;

class ShoppingCartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'shopping-cart');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'shopping-cart');
        $this->loadFactoriesFrom(__DIR__.'/../database/factories');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('shopping-cart.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/shopping-cart'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/shopping-cart'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/shopping-cart'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'shopping-cart');

        $this->app->singleton('shopping-cart', function () {
            return new ShoppingCartRepository();
        });

        $this->app->singleton('shopping-cart-item', function () {
            return new ShoppingCartItemRepository();
        });
    }
}
