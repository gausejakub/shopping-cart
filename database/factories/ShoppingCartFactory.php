<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Gausejakub\ShoppingCart\Models\ShoppingCart::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->uuid,
        'owner_id' => 'testing-owner-id',
    ];
});
