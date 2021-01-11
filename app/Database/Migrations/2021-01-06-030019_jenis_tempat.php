<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisTempat extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'jenis_tempat_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'jenis_tempat_nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'unique' 		 => true,
			],
		]);
		$this->forge->addKey('jenis_tempat_id', true);
		$this->forge->createTable('jenis_tempat');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('jenis_tempat');
	}
}
