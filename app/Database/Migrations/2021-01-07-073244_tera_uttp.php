<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TeraUttp extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'tera_uttp_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tera_uttp_retribusi_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'tera_uttp_merk'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					=> true
			],
			'tera_uttp_tipe'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					=> true
			],
			'tera_uttp_no_seri'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					=> true
			],
			'tera_uttp_merk_kendaraan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					=> true
			],
			'tera_uttp_buatan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					=> true
			],
			'tera_uttp_volume'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_no_polisi'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					=> true
			],
			'tera_uttp_no_kd_plat'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					=> true
			],
			'tera_uttp_pengujian_at'       => [
				'type'           => 'TIMESTAMP',
				'null'	=> true
			],
			'tera_uttp_pengujian_status'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default' => 0
			],
			'tera_uttp_pengujian_status_by'       => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'						=> true
			],
			'tera_uttp_pengujian_status_at'       => [
				'type'           => 'TIMESTAMP',
				'null'	=> true
			],
			'tera_uttp_keterangan'       => [
				'type'           => 'TEXT',
				'null'					=> true
			],
		]);
		$this->forge->addKey('tera_uttp_id', true);
		$this->forge->addForeignKey('tera_uttp_retribusi_id', 'tera_uttp_retribusi', 'tera_uttp_retribusi_id');
		$this->forge->addForeignKey('tera_uttp_pengujian_status_by', 'admin', 'admin_id');
		$this->forge->createTable('tera_uttp');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera_uttp');
	}
}
