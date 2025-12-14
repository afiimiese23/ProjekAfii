<?php

namespace Database\Seeders;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateWargaDummy extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(){
        $faker = \Faker\Factory::create();

        foreach (range(1, 100) as $index) {
            DB::table('warga')->insert([
                'no_ktp' => $faker->unique()->numberBetween(1000000000000000, 9999999999999999),
                'nama'      => $faker->name,
                'jenis_kelamin'   => $faker->randomElement(['male', 'female']),
                'agama'      => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan'      => $faker->jobTitle,
                'phone'      => $faker->phoneNumber,
                'email'      => $faker->unique()->safeEmail,

            ]);
        }
    }
}