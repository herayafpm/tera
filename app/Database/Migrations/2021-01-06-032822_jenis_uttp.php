<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisUttp extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'jenis_uttp_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'jenis_uttp_nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'jenis_uttp_tipe_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'					=> true
			],
			'jenis_uttp_tempat_pakai'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default' 		 => 0,
			],
		]);
		$this->forge->addKey('jenis_uttp_id', true);
		$this->forge->addForeignKey('jenis_uttp_tipe_id', 'jenis_uttp_tipe', 'jenis_uttp_tipe_id');
		$this->forge->createTable('jenis_uttp');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('jenis_uttp');
	}
}
