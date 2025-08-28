<?php

class AuthorizationService {

    public function generateJWT($accountId, $email, $role) {

        $header = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload = json_encode([
            'sub' => $accountId,
            'email' => $email,
            'role' => $role,
            'iat' => time(),
            'exp' => time() + 3600
        ]);

        $base64UrlHeader = rtrim(strtr(base64_encode($header), '+/', '-_'), '=');
        $base64UrlPayload = rtrim(strtr(base64_encode($payload), '+/', '-_'), '=');

        $secret = $_ENV['SECRET_KEY'];

        $signature = hash_hmac(
            'sha256',
            $base64UrlHeader . "." . $base64UrlPayload,
            $secret,
            true
        );
        $base64UrlSignature = rtrim(strtr(base64_encode($signature), '+/', '-_'), '=');

        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

        return $jwt;
    }

    public function validateJWT($jwt){

        $secret = $_ENV['SECRET_KEY'];
        $parts = explode('.', $jwt);
        if (count($parts) !== 3)
            return false;

        list($headerB64, $payloadB64, $signatureB64) = $parts;

        $signatureCheck = hash_hmac(
            'sha256',
            $headerB64 . "." . $payloadB64,
            $secret,
            true
        );
        $signatureCheckB64 = rtrim(strtr(base64_encode($signatureCheck), '+/', '-_'), '=');

        if (!hash_equals($signatureCheckB64, $signatureB64))
            return false;

        $payload = json_decode(base64_decode(strtr($payloadB64, '-_', '+/')), true);

        // Check expiration
        if (isset($payload['exp']) && $payload['exp'] < time())
            return false;        

        return $payload; // Return claims if valid
    }

}