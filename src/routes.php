<?php

Route::group(['namespace' => '\Gausejakub\ShoppingCart\Http'], function () {
    Route::get('/shopping-carts/{shoppingCart}', 'ShoppingCartsController@show');
    Route::post('/shopping-carts', 'ShoppingCartsController@store');
    Route::delete('/shopping-carts/{shoppingCart}', 'ShoppingCartsController@destroy');

    Route::get('/shopping-carts/{shoppingCart}/items', 'ShoppingCartItemsController@index');
    Route::post('/shopping-carts/{shoppingCart}/items', 'ShoppingCartItemsController@store');
    Route::get('/shopping-carts/{shoppingCart}/items/{shoppingCartItem}', 'ShoppingCartItemsController@show');
    Route::put('/shopping-carts/{shoppingCart}/items/{shoppingCartItem}', 'ShoppingCartItemsController@update');
    Route::delete('/shopping-carts/{shoppingCart}/items/{shoppingCartItem}', 'ShoppingCartItemsController@destroy');
});
