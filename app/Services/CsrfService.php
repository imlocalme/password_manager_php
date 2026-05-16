<?php
namespace App\Services;
final class CsrfService {
  public static function token(): string { $_SESSION['_csrf'] ??= bin2hex(random_bytes(32)); return $_SESSION['_csrf']; }
  public static function check(?string $token): bool { return hash_equals($_SESSION['_csrf'] ?? '', (string)$token); }
}
