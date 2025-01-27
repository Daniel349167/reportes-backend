<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1000; $i++) {
            DB::table('users')->insert([
                'nombres'    => $faker->firstName,
                'apellidos'  => $faker->lastName,
                'email'      => $faker->unique()->safeEmail,
                'telefono'   => $faker->phoneNumber,
                'ciudad'     => $faker->city,
                'salario'    => $faker->randomFloat(2, 1000, 10000),
                'birth_date' => $faker->dateTimeBetween('1990-01-01', '2024-12-31')->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
