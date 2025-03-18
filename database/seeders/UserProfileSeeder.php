<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserProfileSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Récupérer tous les utilisateurs sans profil
        $users = User::doesntHave('profile')->get();

        foreach ($users as $user) {
            UserProfile::create([
                'user_id' => $user->id,
                'fist_name' => $faker->firstName,
                'postale_code' => $faker->postcode,
                'city' => $faker->city,
                'age' => $faker->numberBetween(18, 65),
                'sex' => $faker->randomElement(['male', 'female']),
            ]);
        }
    }
}
