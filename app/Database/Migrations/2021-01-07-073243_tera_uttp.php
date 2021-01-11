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
			'jenis_uttp_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'tera_uttp_kapasitas'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'default'				=> 0
			],
			'tera_uttp_daya_baca'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'default'				=> ''
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
		]);
		$this->forge->addKey('tera_uttp_id', true);
		$this->forge->addForeignKey('jenis_uttp_id', 'jenis_uttp', 'jenis_uttp_id');
		$this->forge->createTable('tera_uttp');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera_uttp');
	}
}
