<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Gausejakub\ShoppingCart\Models\ShoppingCartItem::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'price' => $faker->randomNumber(),
        'quantity' => 1,
        'description' => $faker->sentence,
        'shopping_cart_id' => function () {
            return factory(\Gausejakub\ShoppingCart\Models\ShoppingCart::class)->create()->id;
        },
    ];
});
