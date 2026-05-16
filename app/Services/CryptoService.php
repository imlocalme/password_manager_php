<?php

declare(strict_types=1);

namespace App\Services;

use App\Core\Config;

final class CryptoService
{
    private static function key(): string
    {
        $raw = str_replace('base64:', '', (string) Config::get('APP_KEY'));
        return base64_decode($raw, true) ?: hash('sha256', $raw, true);
    }

    public static function encrypt(string $plain): string
    {
        $iv = random_bytes(16);
        $cipher = openssl_encrypt($plain, 'aes-256-gcm', self::key(), OPENSSL_RAW_DATA, $iv, $tag);
        return base64_encode($iv . $tag . $cipher);
    }

    public static function decrypt(string $encoded): string
    {
        $raw = base64_decode($encoded, true) ?: '';
        $iv = substr($raw, 0, 16);
        $tag = substr($raw, 16, 16);
        $cipher = substr($raw, 32);
        return (string)openssl_decrypt($cipher, 'aes-256-gcm', self::key(), OPENSSL_RAW_DATA, $iv, $tag);
    }
}
