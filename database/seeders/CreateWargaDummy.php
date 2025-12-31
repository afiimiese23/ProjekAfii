<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CreateWargaDummy extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // daftar foto dummy
        $avatars = [
            'profile_pictures/dummy/avatar1.jpg',
            'profile_pictures/dummy/avatar2.jpg',
            'profile_pictures/dummy/avatar3.jpg',
            'profile_pictures/dummy/avatar4.jpg',
            'profile_pictures/dummy/avatar5.jpg',
        ];

        foreach (range(1, 100) as $index) {
            DB::table('warga')->insert([
                'no_ktp'        => $faker->unique()->numerify('################'),
                'nama'          => $faker->name,
                'jenis_kelamin' => $faker->randomElement(['Male', 'Female']),
                'agama'         => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan'     => $faker->jobTitle,
                'phone'         => $faker->phoneNumber,
                'email'         => $faker->unique()->safeEmail,

                'profile_picture' => $faker->randomElement($avatars),

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
