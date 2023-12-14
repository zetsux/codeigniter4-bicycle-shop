<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bikes extends Migration
{
    public function up()
    {
        // Foreign Key user
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '36'
            ],
            'brand' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'category' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'stock' => [
                'type' => 'INTEGER',
                'constraint' => '10',
            ],
            'image' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('bikes');
        $this->db->query('ALTER TABLE bikes MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('bikes');
    }
}
