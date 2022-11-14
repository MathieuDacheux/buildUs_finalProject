<?php

class JWT {

    /**
     * Création d'un token JWT
     * @return string
     */
    public static function createToken () :string {
        $databaseConnection = Database::getConnection();
        // Création de l'entête du token
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
        // Création du payload du token
        $payload = json_encode(['Id_user' => $databaseConnection->lastInsertId()]);
        // Encodage de l'entête du token en base 64
        $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
        // Encodage du payload du token en base 64
        $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
        // Signature du token
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
        // Encodage de la signature du token en base 64
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        // Création du token
        $jwt = $base64UrlHeader.'.'.$base64UrlPayload.'.'.$base64UrlSignature;
        return $jwt;
    }

    /**
     * Décodage du token JWT
     * @param string $token
     * 
     * @return int
     */
    public static function decodeToken (string $token) :int {
        // Séparation du token en 3 parties
        $tokenParts = explode('.', $token);
        // Récupération de la signature du token
        $tokenSignatureProvided = $tokenParts[2];
        // Génération d'une clé de hashage du header et du payload
        $signature = hash_hmac('sha256', $tokenParts[0] . "." . $tokenParts[1], 'abC123!', true);
        // Encodage de la signature du token en base 64
        $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
        // Vérification de la signature du token
        if ($base64UrlSignature === $tokenSignatureProvided) {
            $payload = json_decode(base64_decode($tokenParts[1]), true);
            return intval($payload['Id_user'], 10);
        } 
    }
}