<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {

    $companies = App\Company::pluck('id'); // get all id of students

    $first_name = $faker->firstName;
    $last_name = $faker->lastName;
    $email = strtolower(str_replace(' ', '_', $first_name) . '_' . $last_name) . '@gmail.com';

    return [
        'first_name' => $first_name,
        'last_name' => $last_name,
        'email' => $email,
        'phone' => $faker->e164PhoneNumber,
        'company_id' => $faker->randomElement($companies),
    ];
});
