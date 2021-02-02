<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisUttpRetribusi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'jenis_uttp_retribusi_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'jenis_retribusi_tipe_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE
			],
			'jenis_uttp_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
		]);
		$this->forge->addKey('jenis_uttp_retribusi_id', true);
		$this->forge->addForeignKey('jenis_uttp_id', 'jenis_uttp', 'jenis_uttp_id');
		$this->forge->addForeignKey('jenis_retribusi_tipe_id', 'jenis_retribusi_tipe', 'jenis_retribusi_tipe_id');
		$this->forge->createTable('jenis_uttp_retribusi');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('jenis_uttp_retribusi');
	}
}
