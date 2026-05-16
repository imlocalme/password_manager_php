<?php
namespace App\Models;
use App\Core\Database;use App\Core\Model;
final class AuditLog extends Model { protected string $table='audit_logs';
 public function log(int $uid,string $action,string $type,int $modelId): void { Database::query('INSERT INTO audit_logs (user_id,action,model_type,model_id,ip_address,user_agent,created_at) VALUES (:u,:a,:t,:m,:ip,:ua,NOW())',['u'=>$uid,'a'=>$action,'t'=>$type,'m'=>$modelId,'ip'=>$_SERVER['REMOTE_ADDR']??'cli','ua'=>$_SERVER['HTTP_USER_AGENT']??'cli']); }
}
