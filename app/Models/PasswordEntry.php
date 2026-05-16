<?php
namespace App\Models;
use App\Core\Database; use App\Core\Model; use App\Services\CryptoService;
final class PasswordEntry extends Model {
 protected string $table='password_entries';
 public function create(array $d): int {
  Database::query('INSERT INTO password_entries (user_id,title,username,password,url,notes,category_id,folder_id,icon,favorite,created_at,updated_at) VALUES (:u,:t,:un,:pw,:url,:n,:c,:f,:i,:fav,NOW(),NOW())',[
   'u'=>$d['user_id'],'t'=>CryptoService::encrypt($d['title']),'un'=>CryptoService::encrypt($d['username']),'pw'=>CryptoService::encrypt($d['password']),'url'=>CryptoService::encrypt($d['url'] ?? ''),'n'=>CryptoService::encrypt($d['notes'] ?? ''),'c'=>$d['category_id']??null,'f'=>$d['folder_id']??null,'i'=>$d['icon']??null,'fav'=>$d['favorite']??0
  ]); return (int)Database::connection()->lastInsertId();
 }
}
