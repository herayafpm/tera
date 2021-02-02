<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TeraSsrd extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'tera_ssrd_id'          => [
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
			'tera_ssrd_uang'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'default'				=> 0
			],
			'tera_ssrd_terbilang'       => [
				'type'           => 'TEXT',
			],
			'tera_ssrd_bank'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'tera_ssrd_no_rek'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'tera_ssrd_kd_rek'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'tera_ssrd_status'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default' => 0
			],
			'tera_ssrd_status_by'       => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null' 	=> true,
			],
			'tera_ssrd_status_at'       => [
				'type' => 'TIMESTAMP',
				'null'          => TRUE,
			],
			'tera_ssrd_date'       => [
				'type' => 'TIMESTAMP',
				'default'          => date('Y-m-d H:i:s'),
			],
		]);
		$this->forge->addKey('tera_ssrd_id', true);
		$this->forge->addForeignKey('tera_id', 'tera', 'tera_id');
		$this->forge->addForeignKey('tera_ssrd_status_by', 'admin', 'admin_id');
		$this->forge->createTable('tera_ssrd');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera_ssrd');
	}
}
