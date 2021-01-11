<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
  protected $table      = 'admin';
  protected $primaryKey = 'admin_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['admin_username', 'admin_nama', 'role_id', 'admin_password'];

  protected $useTimestamps = true;
  protected $createdField  = 'admin_created';
  protected $updatedField  = 'admin_updated';
  protected $beforeInsert = ['hashPassword'];
  protected $beforeUpdate = ['hashPassword'];
  protected function hashPassword(array $data)
  {
    if (!isset($data['data']['admin_password'])) return $data;
    $data['data']['admin_password'] = password_hash($data['data']['admin_password'], PASSWORD_DEFAULT);
    return $data;
  }

  public function filter($limit, $start, $orderBy, $ordered, $params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->orderBy($orderBy, $ordered); // Untuk menambahkan query ORDER BY
    if ($limit > 0) {
      $builder->limit($limit, $start);
    }
    $builder->select("{$this->table}.*");
    $builder->select("role.*");
    $builder->select("aparatur.*");
    $builder->select("jabatan.*");
    $builder->join('role', "role.role_id = {$this->table}.role_id", 'LEFT');
    $builder->join('aparatur', "aparatur.aparatur_nip = {$this->table}.admin_username", 'LEFT');
    $builder->join('jabatan', "jabatan.jabatan_id = aparatur.jabatan_id", 'LEFT');
    if (isset($params['where'])) {
      $builder->where($params['where']);
    }
    if (isset($params['like'])) {
      foreach ($params['like'] as $key => $value) {
        $builder->like($key, $value);
      }
    }
    $datas = $builder->get()->getResultArray();
    return $datas; // Eksekusi query sql sesuai kondisi diatas
  }
  public function count_all($params = [])
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("role.*");
    $builder->join('role', "role.role_id = {$this->table}.role_id", 'LEFT');
    if (isset($params['where'])) {
      $builder->where($params['where']);
    }
    if (isset($params['like'])) {
      foreach ($params['like'] as $key => $value) {
        $builder->like($key, $value);
      }
    }
    return $builder->countAllResults();
  }
  public function getAdminDetail($id)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->select("role.*");
    $builder->select("aparatur.*");
    $builder->select("jabatan.*");
    $builder->join('role', "role.role_id = {$this->table}.role_id", 'LEFT');
    $builder->join('aparatur', "aparatur.aparatur_nip = {$this->table}.admin_username", 'LEFT');
    $builder->join('jabatan', "jabatan.jabatan_id = aparatur.jabatan_id", 'LEFT');
    $builder->where(['admin_id' => $id]);
    $query = $builder->get()->getRow();
    return $query;
  }
  public function authenticate($username, $password)
  {
    $auth = $this->where('admin_username', $username)->first();
    if ($auth) {
      if (password_verify($password, $auth['admin_password'])) {
        $adminLogModel = new AdminLogModel();
        $adminLogModel->save(['admin_username' => $auth['admin_username']]);
        return $auth;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  public function findByUsername($username)
  {
    return $this->where('admin_username', $username)->first();
  }
  public function is_using($id, $username)
  {
    $aparaturModel = new AparaturModel();
    $aparatur = $aparaturModel->where('aparatur_nip', $username)->first();
    $userModel = new UserModel();
    $user = $userModel->where('verif_by', $id)->first();
    if ($aparatur || $user) {
      return true;
    }
    return false;
  }
}
