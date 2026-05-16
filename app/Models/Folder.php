<?php
namespace App\Models;
use App\Core\Database;use App\Core\Model;
final class Folder extends Model { protected string $table='folders';
 public function create(array $d): int { Database::query('INSERT INTO folders (user_id,name,parent_id,`order`,created_at,updated_at) VALUES (:u,:n,:p,:o,NOW(),NOW())',['u'=>$d['user_id'],'n'=>$d['name'],'p'=>$d['parent_id']??null,'o'=>$d['order']??0]); return (int)Database::connection()->lastInsertId(); }
}
