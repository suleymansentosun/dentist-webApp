<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Doctor;
use Faker\Generator as Faker;

$factory->define(Doctor::class, function (Faker $faker) {
    return [
        'user_id' => factory(App\User::class),
        'name' => $faker->firstName,
        'surname' => $faker->lastName,
        'graduation_date' => $faker->date($format = 'Y-m-d', $max = '2014-01-01'),
        'starting_date_employement' => $faker->dateTimeBetween($startDate = '-5 years', $endDate = 'now'),
        'salary' => $faker->numberBetween($min = 1000, $max = 9000),        
    ];
});
