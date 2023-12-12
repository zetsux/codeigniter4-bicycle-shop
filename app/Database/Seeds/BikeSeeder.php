<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BikeSeeder extends Seeder
{
  public function run()
  {
    $faker = \Faker\Factory::create();
    $data = [];

    for ($i = 0; $i < 20; $i++) {
      $data[] = [
        'id' => $faker->uuid,
        'brand' => $faker->company,
        'name' => $faker->word,
        'category' => $faker->word,
        'description' => $faker->paragraph,
        'price' => $faker->randomFloat(0, 30000, 600000),
        'stock' => random_int(0, 99),
        'color' => $faker->colorName,
        'image' => $faker->imageUrl(200, 300),
      ];
    }

    $this->db->table('bikes')->insertBatch($data);
  }
}
