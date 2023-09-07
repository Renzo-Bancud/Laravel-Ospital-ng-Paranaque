<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

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
        'first_name' => 'Diana',
        'last_name' => 'Binarao',
        'email' => 'fardanph@gmail.com',
        'email_verified_at' => Carbon::now(),
        'password' => \Illuminate\Support\Facades\Hash::make('pppadmin2023'),
        'birth_date' => $faker->dateTime,
        'gender' => 'female',
        'type' => 1,
    ];
});
