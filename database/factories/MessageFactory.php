<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    static $user;
    static $author;

    return [
        'user_id' => $user ? $user : $user = factory(\App\User::class)->create()->id,
        'author_id' => $author ? $author : $author = factory(\App\User::class)->create()->id,
        'body' => $faker->text(rand(50, 130)),
    ];
});
