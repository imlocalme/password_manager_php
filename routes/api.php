<?php
use App\Controllers\AuthController;
use App\Controllers\PasswordController;

return [
 'POST /api/register' => [AuthController::class, 'register'],
 'POST /api/login' => [AuthController::class, 'login'],
 'POST /api/logout' => [AuthController::class, 'logout'],
 'POST /api/passwords' => [PasswordController::class, 'store'],
];
