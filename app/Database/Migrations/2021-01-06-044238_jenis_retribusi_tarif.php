<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisRetribusiTarif extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'jenis_retribusi_tarif_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'jenis_retribusi_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE
			],
			'jenis_tera_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'jenis_tempat_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'jenis_retribusi_tarif_bayar' => [
				'type' => 'INT',
				'constraint'     => 11,
				'default' => 0
			],
		]);
		$this->forge->addKey('jenis_retribusi_tarif_id', true);
		$this->forge->addForeignKey('jenis_retribusi_id', 'jenis_retribusi', 'jenis_retribusi_id', 'CASCADE', 'CASCADE');
		$this->forge->addForeignKey('jenis_tera_id', 'jenis_tera', 'jenis_tera_id');
		$this->forge->addForeignKey('jenis_tempat_id', 'jenis_tempat', 'jenis_tempat_id');
		$this->forge->createTable('jenis_retribusi_tarif');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('jenis_retribusi_tarif');
	}
}
