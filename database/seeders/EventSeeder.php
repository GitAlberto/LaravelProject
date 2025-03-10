<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Créer une instance de Faker
        $faker = Faker::create();

        // Créer 30 événements
        foreach (range(1, 30) as $index) {
            Event::create([
                'title' => $faker->sentence(3),  // Titre aléatoire
                'slug' => $faker->slug,           // Slug généré automatiquement
                'description' => $faker->paragraph,  // Description aléatoire
                'location' => $faker->city,        // Lieu aléatoire
                'date' => $faker->dateTimeBetween('now', '+1 year'),  // Date aléatoire dans l'année à venir
                'category' => $faker->word,        // Catégorie aléatoire
                'max_participants' => $faker->numberBetween(10, 200),  // Nombre de participants aléatoire
            ]);
        }
    }
}
