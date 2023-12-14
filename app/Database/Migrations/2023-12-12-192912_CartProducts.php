<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CartProducts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
                'constraint' => '36'
            ],
            'cart_id' => [
                'type' => 'VARCHAR',
                'constraint' => '36'
            ],
            'bike_id' => [
                'type' => 'VARCHAR',
                'constraint' => '36'
            ],
            'count' => [
                'type' => 'INTEGER',
                'constraint' => '10',
            ],
            'color' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'total_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
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
        $this->forge->createTable('cart_products');
        $this->db->query('ALTER TABLE cart_products MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        //
        $this->forge->dropTable('cart_products');
    }
}
