<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TeraPetugas extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'tera_petugas_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tera_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'tera_petugas_admin' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
		]);
		$this->forge->addKey('tera_petugas_id', true);
		$this->forge->addForeignKey('tera_id', 'tera', 'tera_id');
		$this->forge->addForeignKey('tera_petugas_admin', 'admin', 'admin_id');
		$this->forge->createTable('tera_petugas');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera_petugas');
	}
}
