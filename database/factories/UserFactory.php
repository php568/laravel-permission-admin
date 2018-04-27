<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'remember_token' => str_random(10),
    ];
});

$factory->define(\Spatie\Permission\Models\Role::class, function (Faker $faker) {
    return [
        'display_name' => $faker->jobTitle,
        'name' => $faker->jobTitle,
    ];
});

$factory->define(\Spatie\Permission\Models\Permission::class, function (Faker $faker) {
    return [
        'display_name' => $faker->word,
        'name' => $faker->word,
        'parent_id' => mt_rand(6,20),
    ];
});
