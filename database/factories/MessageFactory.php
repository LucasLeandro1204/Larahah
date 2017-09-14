<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    static $user;
    static $author;

    return [
        'user_id' => $user ?: $user = \App\User::first()->id,
        'author_id' => $author ?: $author = \App\User::where('id', '!=', $user)->first()->id,
        'body' => $faker->text(rand(50, 130)),
    ];
});
