<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Loan::class, function (Faker\Generator $faker) {

    return [
        'loan_amount' => $faker->randomFloat($nbMaxDecimals = 6, $min = 1000, $max = 100000000),
        'loan_term' => $faker->numberBetween($min = 1,$max = 50),
        'interest_rate' => $faker->randomFloat($nbMaxDecimals = 6, $min = 1, $max = 36),
    ];
});
