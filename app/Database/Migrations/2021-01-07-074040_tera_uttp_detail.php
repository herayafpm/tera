<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TeraUttpDetail extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'tera_uttp_detail_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'tera_uttp_id' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
			],
			'tera_uttp_detail_buatan'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					=> true
			],
			'tera_uttp_detail_volume'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_no_polisi'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					=> true
			],
			'tera_uttp_detail_no_kd_plat'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					=> true
			],
			'tera_uttp_detail_t1_muka'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_t1_belakang'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_t2_muka'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_t2_belakang'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_t3_muka'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_t3_belakang'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_t4_muka'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_t4_belakang'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_t_muka'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_t_belakang'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_d_muka'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_d_belakang'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_p_muka'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_p_belakang'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_q_muka'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_q_belakang'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_s_muka'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
			'tera_uttp_detail_s_belakang'       => [
				'type'           => 'INT',
				'constraint'     => 11,
				'null'					=> true
			],
		]);
		$this->forge->addKey('tera_uttp_detail_id', true);
		$this->forge->addForeignKey('tera_uttp_id', 'tera_uttp', 'tera_uttp_id');
		$this->forge->createTable('tera_uttp_detail');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('tera_uttp_detail');
	}
}
