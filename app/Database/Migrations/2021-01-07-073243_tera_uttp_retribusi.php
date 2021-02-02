<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TeraUttpRetribusi extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'tera_uttp_retribusi_id'          => [
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
			'tera_uttp_jumlah'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'default'				=> 0
			],
			'jenis_retribusi_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'					=> true,
			],
			'tera_uttp_retribusi' => [
				'type' => 'INT',
				'constraint'     => 11,
				'default'					=> 0,
			],
			'tera_uttp_keringanan' => [
				'type' => 'INT',
				'constraint'     => 11,
				'default'					=> 0,
			],
			'tera_uttp_sanksi_adm' => [
				'type' => 'INT',
				'constraint'     => 11,
				'default'					=> 0,
			],
		]);
		$this->forge->addKey('tera_uttp_retribusi_id', true);
		$this->forge->addForeignKey('tera_id', 'tera', 'tera_id');
		$this->forge->addForeignKey('jenis_retribusi_id', 'jenis_retribusi', 'jenis_retribusi_id');
		$this->forge->addForeignKey('jenis_uttp_id', 'jenis_uttp', 'jenis_uttp_id');
		$this->forge->createTable('tera_uttp_retribusi');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera_uttp_retribusi');
	}
}
