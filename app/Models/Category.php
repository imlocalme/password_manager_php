<?php
namespace App\Models;
use App\Core\Database;use App\Core\Model;use App\Services\CryptoService;
final class Category extends Model { protected string $table='categories';
 public function create(array $d): int { Database::query('INSERT INTO categories (user_id,name,color,is_private,created_at,updated_at) VALUES (:u,:n,:c,:p,NOW(),NOW())',['u'=>$d['user_id'],'n'=>CryptoService::encrypt($d['name']),'c'=>$d['color']??'#64748b','p'=>$d['is_private']??1]); return (int)Database::connection()->lastInsertId(); }
}
