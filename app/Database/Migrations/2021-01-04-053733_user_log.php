<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserLog extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'user_log_id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'user_nik'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '255',
			],
			'user_log_at'       => [
				'type'           => 'TIMESTAMP'
			],
		]);
		$this->forge->addKey('user_log_id', true);
		$this->forge->createTable('user_log');
		$this->db->enableForeignKeyChecks();
	}

	public function down()
	{
		$this->forge->dropTable('user_log');
	}
}
