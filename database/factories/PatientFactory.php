<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'citizenship_number' => $faker->numerify('###########'),
        'phone_number' => $faker->tollFreePhoneNumber, 
    ];
});
