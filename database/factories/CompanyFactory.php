<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Company::class, function (Faker $faker) {
    $company = $faker->company;
    $clean_company = str_replace(',', '', strtolower($company));
    $email = strtolower($faker->firstName) . '@' . str_replace(' ', '', $clean_company) . '.com';
    $website = 'www.' . str_replace(' ', '-', $clean_company) . '.com';
    
    return [
        'name' => $company,
        'email' => $email,
        'address' => $faker->address,
        'website' => $website,
    ];
});
