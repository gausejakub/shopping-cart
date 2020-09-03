<?php

Route::group(['namespace' => '\Gausejakub\ShoppingCart\Http'], function () {
    Route::get('/shopping-carts/{shoppingCart}', 'ShoppingCartsController@show');
    Route::post('/shopping-carts', 'ShoppingCartsController@store');
    Route::delete('/shopping-carts/{shoppingCart}', 'ShoppingCartsController@destroy');
});
