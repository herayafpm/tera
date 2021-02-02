<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tera extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'tera_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'user_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'tera_no_pendaftaran'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'tera_no_order'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'tera_atas_nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'tera_atas_nama_alamat'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'jenis_tera_id'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'jenis_tempat_id'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'tera_status'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default'     => 0,
			],
			'tera_status_by'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'					=> true,
			],
			'tera_status_at'       => [
				'type'           => 'TIMESTAMP',
				'null'					=> true
			],
			'tera_keringanan_at'       => [
				'type'           => 'TIMESTAMP',
				'null'					=> true,
			],
			'tera_keringanan_by'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'					=> true,
			],
			'tera_status_bayar'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default'     => 0,
			],
			'tera_status_pengujian'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default'     => 0,
			],
			'tera_total_terbilang'       => [
				'type'           => 'TEXT',
				'null'     => true,
			],
			'tera_skrdkb_terbilang'       => [
				'type'           => 'TEXT',
				'null'     => true,
			],
			'tera_skrdlb_terbilang'       => [
				'type'           => 'TEXT',
				'null'     => true,
			],
			'tera_ketetapan_at'       => [
				'type'           => 'TIMESTAMP',
				'null'					=> true,
			],
			'tera_ketetapan_by'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'					=> true,
			],
			'tera_skrdkb_at'       => [
				'type'           => 'TIMESTAMP',
				'null'					=> true,
			],
			'tera_skrdkb_by'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'					=> true,
			],
			'tera_skrdlb_at'       => [
				'type'           => 'TIMESTAMP',
				'null'					=> true,
			],
			'tera_skrdlb_by'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'					=> true,
			],
			'tera_date_order'       => [
				'type'           => 'TIMESTAMP',
				'default' => date('Y-m-d H:i:s')
			],
			'tera_created'       => [
				'type'           => 'TIMESTAMP',
				'default' => date('Y-m-d H:i:s')
			],
		]);
		$this->forge->addKey('tera_id', true);
		$this->forge->addForeignKey('jenis_tempat_id', 'jenis_tempat', 'jenis_tempat_id');
		$this->forge->addForeignKey('jenis_tera_id', 'jenis_tera', 'jenis_tera_id');
		$this->forge->addForeignKey('user_id', 'user', 'user_id');
		$this->forge->addForeignKey('tera_status_by', 'admin', 'admin_id');
		$this->forge->addForeignKey('tera_ketetapan_by', 'admin', 'admin_id');
		$this->forge->addForeignKey('tera_keringanan_by', 'admin', 'admin_id');
		$this->forge->addForeignKey('tera_skrdkb_by', 'admin', 'admin_id');
		$this->forge->addForeignKey('tera_skrdlb_by', 'admin', 'admin_id');
		$this->forge->createTable('tera');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera');
	}
}
