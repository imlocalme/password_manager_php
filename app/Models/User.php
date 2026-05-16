<?php
namespace App\Models;
use App\Core\Database;
use App\Core\Model;

final class User extends Model {
 protected string $table='users';
 public function create(array $data): int {
  Database::query('INSERT INTO users (name,email,password,created_at,updated_at) VALUES (:n,:e,:p,NOW(),NOW())',[
   'n'=>$data['name'],'e'=>$data['email'],'p'=>password_hash($data['password'], PASSWORD_DEFAULT)
  ]);
  return (int)Database::connection()->lastInsertId();
 }
 public function byEmail(string $email): ?array {
  $r=Database::query('SELECT * FROM users WHERE email=:e LIMIT 1',['e'=>$email])->fetch(); return $r?:null;
 }
}
