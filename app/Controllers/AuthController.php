<?php
namespace App\Controllers;
use App\Models\User; use App\Services\RateLimiter; use App\Services\CsrfService;
final class AuthController {
 public function register(): array { $in=$_POST; if(!CsrfService::check($in['_csrf']??null)) return ['error'=>'csrf']; if(!filter_var($in['email']??'', FILTER_VALIDATE_EMAIL)) return ['error'=>'invalid email']; if(strlen($in['password']??'')<12) return ['error'=>'weak password']; $id=(new User())->create($in); return ['user_id'=>$id]; }
 public function login(): array { if(!RateLimiter::hit('login:'.($_SERVER['REMOTE_ADDR']??'x'),5,300)) return ['error'=>'too many']; $u=(new User())->byEmail($_POST['email']??''); if(!$u||!password_verify($_POST['password']??'', $u['password'])) return ['error'=>'invalid']; session_regenerate_id(true); $_SESSION['user_id']=$u['id']; return ['ok'=>true]; }
 public function logout(): array { session_destroy(); return ['ok'=>true]; }
}
