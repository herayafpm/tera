<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table      = 'user';
  protected $primaryKey = 'user_id';

  protected $returnType     = 'array';

  protected $allowedFields = ['user_nik', 'user_nama', 'user_alamat', 'user_telepon', 'role_id', 'user_password'];

  protected $useTimestamps = true;
  protected $createdField  = 'user_created';
  protected $updatedField  = 'user_updated';
  protected $beforeInsert = ['hashPassword'];
  protected $beforeUpdate = ['hashPassword'];
  protected function hashPassword(array $data)
  {
    if (!isset($data['data']['user_password'])) return $data;
    $data['data']['user_password'] = password_hash($data['data']['user_password'], PASSWORD_DEFAULT);
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
    $builder->select("admin.*");
    $builder->join('admin', "admin.admin_id = {$this->table}.verif_by", 'LEFT');
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
    $builder->select("admin.*");
    $builder->join('admin', "admin.admin_id = {$this->table}.verif_by", 'LEFT');
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
  public function getUserDetail($id)
  {
    $builder = $this->db->table($this->table);
    $builder->select("{$this->table}.*");
    $builder->where(['user_id' => $id]);
    $query = $builder->get()->getRow();
    return $query;
  }
  public function update_data($where, $data)
  {
    return $this->where($where)->set($data)->update();
  }
  public function authenticate($nik, $password)
  {
    $auth = $this->where('user_nik', $nik)->first();
    if ($auth) {
      if (password_verify($password, $auth['user_password'])) {
        $userLogModel = new UserLogModel();
        $userLogModel->save(['user_nik' => $auth['user_nik']]);
        $this->update($auth['user_id'], ['last_login' => date('Y-m-d H:i:s')]);
        return $auth;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  public function findByNIK($nik)
  {
    return $this->where('user_nik', $nik)->first();
  }
  // public function is_using($id, $nik)
  // {
  //   $aparaturModel = new AparaturModel();
  //   $aparatur = $aparaturModel->where('aparatur_nip', $nik)->first();
  //   $userModel = new UserModel();
  //   $user = $userModel->where('verif_by', $id)->first();
  //   if ($aparatur || $user) {
  //     return true;
  //   }
  //   return false;
  // }
}
