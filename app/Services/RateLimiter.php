<?php
namespace App\Services;
final class RateLimiter {
  public static function hit(string $key, int $max, int $window): bool {
    $now = time();
    $_SESSION['_ratelimit'][$key] ??= [];
    $_SESSION['_ratelimit'][$key] = array_values(array_filter($_SESSION['_ratelimit'][$key], fn($ts) => $ts > $now - $window));
    if (count($_SESSION['_ratelimit'][$key]) >= $max) return false;
    $_SESSION['_ratelimit'][$key][] = $now;
    return true;
  }
}
