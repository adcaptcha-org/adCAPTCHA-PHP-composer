<?php

namespace App\Verify;

class Verify
{
    public function verify(string $apiKey, string $token) {
        $url = 'https://api.adcaptcha.com/verify';
        // Initialize cURL
        $ch = curl_init($url);
        // Set cURL options
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['token' => $token]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $apiKey,
            'Content-Type: application/json; charset=utf-8'
        ]);
        // Execute the request
        $response = curl_exec($ch);
        // Handle cURL errors
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            return ['error' => "Error: $error"];
        }
        // Close cURL and handle the response
        curl_close($ch);
        return json_decode($response, true);
    }
}
