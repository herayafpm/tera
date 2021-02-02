<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TeraPengajuan extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'tera_pengajuan_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tera_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'						=> true,
			],
			'user_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'tera_pengajuan_keterangan'       => [
				'type'           => 'TEXT',
			],
			'tera_pengajuan_petugas_satu' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'tera_pengajuan_petugas_dua' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'							=> true
			],
			'tera_pengajuan_status'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default' => 0
			],
			'tera_pengajuan_status_by'       => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null' 	=> true,
			],
			'tera_pengajuan_status_at'       => [
				'type' => 'TIMESTAMP',
				'null'          => TRUE,
			],
			'tera_pengajuan_date'       => [
				'type' => 'TIMESTAMP',
				'default'          => date('Y-m-d H:i:s'),
			],
			'tera_pengajuan_date_order'       => [
				'type' => 'TIMESTAMP',
				'default'          => date('Y-m-d H:i:s'),
			],
		]);
		$this->forge->addKey('tera_pengajuan_id', true);
		$this->forge->addForeignKey('tera_id', 'tera', 'tera_id');
		$this->forge->addForeignKey('user_id', 'user', 'user_id');
		$this->forge->addForeignKey('tera_pengajuan_status_by', 'admin', 'admin_id');
		$this->forge->createTable('tera_pengajuan');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera_pengajuan');
	}
}
