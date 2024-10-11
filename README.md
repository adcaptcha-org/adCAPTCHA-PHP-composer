# Verify adCAPTCHA PHP Package

---

This PHP package verifying AdCAPTCHA tokens. The Verify class is used to verify a success token that is exposed after the successful completion of a CAPTCHA challenge.

## Installation

---

To use this package, include it in your project using Composer. If you haven't already set up Composer, follow the Composer installation guide.

Add the package to your project with:

```php
composer require acmecorp/verify-adcaptcha

```

## Usage

## API key

The API Key is your secret key required for the verification step. You need to generate this key from the AdCAPTCHA dashboard.

Refer to the AdCAPTCHA documentation to learn how to create an API Key.

**Token**

The token is exposed when the CAPTCHA has been successfully solved. You need to provide this token to verify the CAPTCHA.

**Example**

Here is an example of how to use the Verify class to verify a CAPTCHA token:

```php

<?php
// Use autoload
require "vendor/autoload.php";
use App\Verify\Verify;

// Your API key and token
$apiKey = 'secret_key'; // Make sure to store this securely in real applications
$token = 'captcha_success_token';

// Create an instance of the Verify class
$verifier = new Verify();

try {
  // Call the verify method and get the HTTP response code
  $responseCode = $verifier->verify($apiKey, $token);
  $message = isset($responseCode['message']) ? $responseCode['message'] : 'No message found';
  // Output the HTTP response code
  echo "Response Data: $message";

} catch (Exception $e) {
  // Handle the exception
  echo "An error occurred: " . $e->getMessage();
}

```

## Response from Verify

The verify method will return an array containing the HTTP response code and additional response details. Below are the possible status codes and their meanings:

| Status Code | Message                |
| ----------- | ---------------------- |
| 200         | Token verified         |
| 400         | Token missing          |
| 400         | Invalid token          |
| 400         | Token already verified |
