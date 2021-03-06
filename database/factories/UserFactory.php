<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'role_id'=> $faker->numberBetween(1,3),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'category_id' => $faker->numberBetween(1,4),
        'photo_id' => 1,
        'title'=>$faker->sentence(7,11),
        'body'=>$faker->paragraphs(rand(10,15), true),
        'slug'=>$faker->slug(),
    ];
});

$factory->define(App\Role::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['admin', 'author', 'subscriber']),
        ];
});

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['PHP', 'JavaScript', 'Laravel', 'Java', 'Other']),
        ];
});


$factory->define(App\Photo::class, function (Faker $faker) {
    return [
        'file' => 'placeholder.jpg',
    ];
});

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'post_id' => $faker->numberBetween(1,10),
        'is_active'=>1,
        'photo' => 'placeholder.jpg',
        'author'=>$faker->name,
        'body'=>$faker->paragraphs(1, true),
        'email'=>$faker->safeEmail,
    ];
});

$factory->define(App\CommentReply::class, function (Faker $faker) {
    return [
        'is_active'=>1,
        'photo' => 'placeholder.jpg',
        'author'=>$faker->name,
        'body'=>$faker->paragraphs(1, true),
        'email'=>$faker->safeEmail,
    ];
});
