<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
{
	public function up()
	{
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ],
            'name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '100',
            ],
            'parent_id' => [
                'type'           => 'int',
                'null'           => TRUE,
                'unsigned'       => TRUE,
                'constraint' => 11,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('categories');
        $this->db->query('ALTER TABLE categories ADD FOREIGN KEY(parent_id) REFERENCES categories(id) ON DELETE CASCADE ON UPDATE CASCADE;');


    }

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
