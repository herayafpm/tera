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
			'tera_status'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default'     => 0,
			],
			'tera_status_bayar'       => [
				'type'           => 'INT',
				'constraint'     => 1,
				'default'     => 0,
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
		$this->forge->addForeignKey('user_id', 'user', 'user_id');
		$this->forge->createTable('tera');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera');
	}
}
