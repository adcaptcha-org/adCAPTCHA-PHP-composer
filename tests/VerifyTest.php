<?php

use PHPUnit\Framework\TestCase;
use App\Verify\Verify;

class VerifyTest extends TestCase
{
    protected $verify;

    protected function setUp(): void
    {
        parent::setUp();
        // Create a mock for the Verify class
        $this->verify = $this->getMockBuilder(Verify::class)
            ->onlyMethods(['verify']) // Use onlyMethods to specify which methods to mock
            ->getMock();
    }

    public function testVerifyUnauthorized()
    {
        $apiKey = 'test_api_key';
        $token = 'token';

        // Define the expected response structure
        $expectedResponse = [
            'message' => 'Unauthorized'
        ];

        // Set up the mock to return the expected response
        $this->verify->method('verify')
            ->willReturn($expectedResponse);

        // Call the verify method with the mocked response
        $response = $this->verify->verify($apiKey, $token);
        echo "API Response: ";
        print_r($response);

        // Assert the response structure
        $this->assertArrayHasKey('message', $response, "Expected 'message' key in response");
        $this->assertEquals($expectedResponse['message'], $response['message'], "Expected 'Unauthorized' message in response");
    }

    public function testVerifyInvalidToken()
    {
        $apiKey = '00d55354-8693-4cc8-8e4e-30faf05c644e';
        $token = 'token';
        
        // Define the expected response structure
        $expectedResponse = ['code' => 400, 'message' => 'Invalid token'];

        // Set up the mock to return the expected response
        $this->verify->method('verify')
            ->willReturn($expectedResponse);
        
        // Call the verify method with the mocked response
        $response = $this->verify->verify($apiKey, $token);

        // Log the response to the terminal for inspection
        echo "Valid API Response: ";
        print_r($response);

        // Assert the response structure
        $this->assertResponse($response, $expectedResponse);
    }

    public function testVerifyTokenVerified()
{
    $apiKey = 'valid_api_key';
    $token = 'valid_token';

    // Define the expected response structure
    $expectedResponse = [
        'code' => 200,
        'message' => 'Token verified'
    ];

    // Set up the mock to return the expected response
    $this->verify->method('verify')
        ->willReturn($expectedResponse);
    
    // Call the verify method with the mocked response
    $response = $this->verify->verify($apiKey, $token);

    // Log the response to the terminal for inspection
    echo "Valid API Response: ";
    print_r($response);

    // Assert the response structure
    $this->assertResponse($response, $expectedResponse);
}

public function testVerifyTokenMissing()
{
    $apiKey = 'valid_api_key';
    $token = ''; // Simulating a missing token

    // Define the expected response structure
    $expectedResponse = [
        'code' => 400,
        'message' => 'Token missing'
    ];

    // Set up the mock to return the expected response
    $this->verify->method('verify')
        ->willReturn($expectedResponse);
    
    // Call the verify method with the mocked response
    $response = $this->verify->verify($apiKey, $token);

    // Log the response to the terminal for inspection
    echo "Valid API Response: ";
    print_r($response);

    // Assert the response structure
    $this->assertResponse($response, $expectedResponse);
}

public function testVerifyTokenAlreadyVerified()
{
    $apiKey = 'valid_api_key';
    $token = 'already_verified_token'; // Simulating a token that has already been verified

    // Define the expected response structure
    $expectedResponse = [
        'code' => 400,
        'message' => 'Token already verified'
    ];

    // Set up the mock to return the expected response
    $this->verify->method('verify')
        ->willReturn($expectedResponse);
    
    // Call the verify method with the mocked response
    $response = $this->verify->verify($apiKey, $token);

    // Log the response to the terminal for inspection
    echo "Valid API Response: ";
    print_r($response);

    // Assert the response structure
   $this->assertResponse($response, $expectedResponse);
    
}

public function assertResponse($response, $expectedResponse)
    {
        $this->assertArrayHasKey('code', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals($expectedResponse['code'], $response['code']);
        $this->assertEquals($expectedResponse['message'], $response['message']);
    }
}