<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jabatan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'jabatan_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'jabatan_nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'unique' 		 => true,
			],
		]);
		$this->forge->addKey('jabatan_id', true);
		$this->forge->createTable('jabatan');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('jabatan');
	}
}
