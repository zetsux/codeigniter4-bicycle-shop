<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BikeSeeder extends Seeder
{
  public function run()
  {
    $faker = \Faker\Factory::create();
    $data = [];

    $imageUrls = [
      'https://cdn.discordapp.com/attachments/1032505826885238864/1184984846121054248/Bicycle_-_640x406_3.png?ex=658df623&is=657b8123&hm=f916b38a542c2a0c99197a274759e35c2abe7eb05b9be7c0e87a461affc6f35c&',
      'https://cdn.discordapp.com/attachments/1032505826885238864/1184982254456414338/Bicycle_-_640x406.png?ex=658df3b9&is=657b7eb9&hm=954898da0c6afd8fb53717bf1b8e9f3ca1b3a2792e86633f8d297a5a622b21e3&',
      'https://cdn.discordapp.com/attachments/1032505826885238864/1184982254729056276/Bicycle_-_640x406_2.png?ex=658df3b9&is=657b7eb9&hm=b1726107a4c5d09f0394c12af5b16ce9197aef4c8598079bd7e47a341026f337&',
      'https://cdn.discordapp.com/attachments/1032505826885238864/1184982255001669733/Bicycle_-_640x406_1.png?ex=658df3b9&is=657b7eb9&hm=a78a32b9b514a34d765d398e3cbd705f93fc9a1ff2ce2b0a7b35d5586fd9e177&',
      'https://cdn.discordapp.com/attachments/1032505826885238864/1184982255316246719/Bicycle_-_640x400.png?ex=658df3b9&is=657b7eb9&hm=e6c0719efde8d3a7e3575e17bfc0ba138b8df0be902f35a50eaa917dcf440a6f&',
    ];

    $brands = ['Schwinn', 'Trek', 'Giant', 'Cannondale', 'Specialized'];
    $categories = ['Mountain', 'Road', 'Hybrid', 'City', 'BMX'];
    $descriptions = [
      'A high-quality bicycle suitable for both beginners and experienced riders.',
      'Designed for off-road adventures with durable components.',
      'Perfect for commuting and leisure rides in the city.',
      'Lightweight and aerodynamic, ideal for speed and efficiency.',
      'Sturdy construction for tricks and stunts, great for BMX enthusiasts.',
    ];

    for ($i = 0; $i < 20; $i++) {
      $data[] = [
        'id' => $faker->uuid,
        'brand' => $brands[array_rand($brands)],
        'name' => $faker->word,
        'category' => $categories[array_rand($categories)],
        'description' => $descriptions[array_rand($descriptions)],
        'price' => $faker->randomFloat(0, 30000, 600000),
        'stock' => random_int(0, 99),
        'image' => $imageUrls[array_rand($imageUrls)],
      ];
    }

    $this->db->table('bikes')->insertBatch($data);
  }
}
