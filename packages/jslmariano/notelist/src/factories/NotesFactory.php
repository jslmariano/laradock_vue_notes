<?php
use Faker\Generator as Faker;
use Jslmariano\Notelist\Models\Notes;

$factory->define(Notes::class, function (Faker $faker) {
    return [
        'title'   => $faker->lexify(str_repeat('?', 50)),
        'content' => $faker->lexify(str_repeat('?', 200)),
        'created_user' => User::all()->random()->user_id,
        'updated_user' => User::all()->random()->user_id,
    ];
});
