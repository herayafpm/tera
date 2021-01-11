<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisTera extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'jenis_tera_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'jenis_tera_nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'unique' 		 => true,
			],
		]);
		$this->forge->addKey('jenis_tera_id', true);
		$this->forge->createTable('jenis_tera');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('jenis_tera');
	}
}
