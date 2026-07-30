<?php

declare(strict_types=1);

namespace App\Application\Security;

class TokenService
{
    private string $secret;

    private int $ttl;

    public function __construct(string $secret, int $ttl)
    {
        $this->secret = $secret;
        $this->ttl = $ttl;
    }

    public function generate(array $admin): string
    {
        $header = $this->base64UrlEncode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
        $payload = $this->base64UrlEncode(json_encode([
            'sub' => $admin['id'],
            'email' => $admin['email'],
            'exp' => time() + $this->ttl,
        ]));

        $signature = $this->sign("{$header}.{$payload}");

        return "{$header}.{$payload}.{$signature}";
    }

    public function validate(string $token): ?array
    {
        $parts = explode('.', $token);
        if (count($parts) !== 3) {
            return null;
        }

        [$header, $payload, $signature] = $parts;
        $expected = $this->sign("{$header}.{$payload}");
        if (!hash_equals($expected, $signature)) {
            return null;
        }

        $decoded = json_decode($this->base64UrlDecode($payload), true);
        if (!is_array($decoded) || !isset($decoded['sub'], $decoded['exp']) || $decoded['exp'] < time()) {
            return null;
        }

        return $decoded;
    }

    private function sign(string $data): string
    {
        return $this->base64UrlEncode(hash_hmac('sha256', $data, $this->secret, true));
    }

    private function base64UrlEncode(string $value): string
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }

    private function base64UrlDecode(string $value): string
    {
        $remainder = strlen($value) % 4;
        if ($remainder !== 0) {
            $value .= str_repeat('=', 4 - $remainder);
        }

        return base64_decode(strtr($value, '-_', '+/')) ?: '';
    }
}
