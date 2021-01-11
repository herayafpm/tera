<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Aparatur extends Migration
{
	public function up()
	{
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'aparatur_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'aparatur_nip'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'unique'					=> true,
			],
			'aparatur_nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'aparatur_pangkat'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'jabatan_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'aparatur_created'       => [
				'type'           => 'TIMESTAMP',
				'default' => date('Y-m-d H:i:s')
			],
			'aparatur_updated'       => [
				'type'           => 'TIMESTAMP',
				'default' => date('Y-m-d H:i:s')
			],
		]);
		$this->forge->addKey('aparatur_id', true);
		$this->forge->addForeignKey('jabatan_id', 'jabatan', 'jabatan_id');
		$this->forge->createTable('aparatur');
	}

	public function down()
	{
		$this->forge->dropTable('aparatur');
	}
}
