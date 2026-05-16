<?php
namespace App\Controllers;
use App\Models\PasswordEntry;use App\Models\AuditLog;
final class PasswordController {
 public function store(): array { $d=$_POST; $d['user_id']=(int)$_SESSION['user_id']; $id=(new PasswordEntry())->create($d); (new AuditLog())->log($d['user_id'],'create','password_entries',$id); return ['id'=>$id]; }
}
