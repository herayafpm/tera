<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JenisUttpTipe extends Migration
{
  public function up()
  {
    $this->forge->addField([
      'jenis_uttp_tipe_id'          => [
        'type'           => 'INT',
        'constraint'     => 11,
        'unsigned'       => true,
        'auto_increment' => true,
      ],
      'jenis_uttp_tipe_nama'       => [
        'type'           => 'VARCHAR',
        'constraint'     => '255',
      ],
    ]);
    $this->forge->addKey('jenis_uttp_tipe_id', true);
    $this->forge->createTable('jenis_uttp_tipe');
    $this->db->enableForeignKeyChecks();
  }

  public function down()
  {
    $this->forge->dropTable('jenis_uttp_tipe');
  }
}
