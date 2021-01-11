<?php

namespace App\Validations;

use App\Models\UserModel;

class MyRules
{
  public function update_pass(string $str, $length = 6): bool
  {
    if (empty($str)) {
      return true;
    }
    if (strlen($str) >= $length) {
      return true;
    }
    return false;
  }
  public function min_length_array(array $arr, $length = 5): bool
  {
    $arr = $arr[0];
    $arr = explode(',', $arr);
    if (sizeof($arr) >= $length) {
      return true;
    }
    return false;
  }
  public function find_nik(string $str): bool
  {
    $userModel = new UserModel();
    $user = $userModel->where('user_nik', $str)->first();
    if ($user) {
      return true;
    }
    return false;
  }
  public function correct_pass(string $str, $id): bool
  {
    $userModel = new UserModel();
    $user = $userModel->where('user_id', $id)->first();
    if (password_verify($str, $user['user_password'])) {
      return true;
    }
    return false;
  }
}
