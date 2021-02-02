<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TeraSkrdlb extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'tera_skrdlb_id'          => [
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
			'tera_skrdlb_keterangan'       => [
				'type'           => 'TEXT',
				'null'					=> true
			],
			'tera_skrdlb_status'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default' => 0
			],
			'tera_skrdlb_status_by'       => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null' 	=> true,
			],
			'tera_skrdlb_status_at'       => [
				'type' => 'TIMESTAMP',
				'null'          => TRUE,
			],
			'tera_skrdlb_date'       => [
				'type' => 'TIMESTAMP',
				'default'          => date('Y-m-d H:i:s'),
			],
		]);
		$this->forge->addKey('tera_skrdlb_id', true);
		$this->forge->addForeignKey('tera_id', 'tera', 'tera_id');
		$this->forge->addForeignKey('tera_skrdlb_status_by', 'admin', 'admin_id');
		$this->forge->createTable('tera_skrdlb');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera_skrdlb');
	}
}
