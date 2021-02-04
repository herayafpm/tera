<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->db->enableForeignKeyChecks();
		$this->forge->addField([
			'user_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'user_nik'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'unique' 		 => true,
			],
			'user_nama'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'user_alamat'       => [
				'type'           => 'TEXT',
			],
			// 'user_tempat_lahir'       => [
			// 	'type'           => 'VARCHAR',
			// 	'constraint'     => '255',
			// ],
			// 'user_tanggal_lahir'       => [
			// 	'type'           => 'VARCHAR',
			// 	'constraint'     => '255',
			// ],
			// 'user_jk'       => [
			// 	'type'           => 'VARCHAR',
			// 	'constraint'     => '255',
			// ],
			// 'user_desa'       => [
			// 	'type'           => 'VARCHAR',
			// 	'constraint'     => '255',
			// ],
			// 'user_rt'       => [
			// 	'type'           => 'INT',
			// 	'constraint'     => 11,
			// ],
			// 'user_rw'       => [
			// 	'type'           => 'INT',
			// 	'constraint'     => 11,
			// ],
			// 'user_kecamatan'       => [
			// 	'type'           => 'VARCHAR',
			// 	'constraint'     => '255',
			// ],
			// 'user_kabupaten'       => [
			// 	'type'           => 'VARCHAR',
			// 	'constraint'     => '255',
			// ],
			// 'user_provinsi'       => [
			// 	'type'           => 'VARCHAR',
			// 	'constraint'     => '255',
			// ],
			'user_telepon'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
				'null'					 => true,
			],
			'last_login'       => [
				'type'           => 'TIMESTAMP',
				'null'     => true,
			],
			'verif_by' => [
				'type' => 'INT',
				'constraint'     => 11,
				'unsigned'          => TRUE,
				'null'					=> true
			],
			// 'verif_at' => [
			// 	'type' => 'TIMESTAMP',
			// 	'null' => true
			// ],
			'user_password'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'user_created'       => [
				'type'           => 'TIMESTAMP',
				'default' => date('Y-m-d H:i:s')
			],
			'user_updated'       => [
				'type'           => 'TIMESTAMP',
				'default' => date('Y-m-d H:i:s')
			],
		]);
		$this->forge->addKey('user_id', true);
		$this->forge->addForeignKey('verif_by', 'admin', 'admin_id');
		$this->forge->createTable('user');
	}

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
