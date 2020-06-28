<?php

use App\Models\Transaction;
use Faker\Generator as Faker;

/**
 * @var \Illuminate\Database\Eloquent\Factory $factory
 */
$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'title' => 'Mr.',
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'mobile_number' => 1,
        'amount_required' => 5000,
        'term' => 2,
        'repayment_amount' => 5500,
        'interest' => 500,
        'establishment_fee' => 300
    ];
});
