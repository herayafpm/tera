<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TeraKeringanan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'tera_keringanan_id'          => [
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
			'tera_keringanan_keterangan'       => [
				'type'           => 'TEXT',
				'null'					=> true
			],
			'tera_keringanan_status'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default' => 0
			],
			'tera_keringanan_status_by'       => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null' 	=> true,
			],
			'tera_keringanan_status_at'       => [
				'type' => 'TIMESTAMP',
				'null'          => TRUE,
			],
			'tera_keringanan_date'       => [
				'type' => 'TIMESTAMP',
				'default'          => date('Y-m-d H:i:s'),
			],
		]);
		$this->forge->addKey('tera_keringanan_id', true);
		$this->forge->addForeignKey('tera_id', 'tera', 'tera_id');
		$this->forge->addForeignKey('tera_keringanan_status_by', 'admin', 'admin_id');
		$this->forge->createTable('tera_keringanan');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera_keringanan');
	}
}
