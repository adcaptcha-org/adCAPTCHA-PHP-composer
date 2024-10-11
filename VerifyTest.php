<?php

use phpmock\phpunit\PHPMock;
use PHPUnit\Framework\TestCase;
use App\Verify\Verify;

class VerifyTest extends TestCase
{
    
    public function testVerifyUnauthorized()
{
    $apiKey = 'test_api_key';
    $token = 'token';

    // Mock the cURL functions
    // $this->mockCurlFunctions(json_encode($expectedResponse), 400);

    $verify = new Verify();
    $response = $verify->verify($apiKey, $token);
    echo "API Response: ";
    print_r($response);

            // Define the expected response structure
            $expectedResponse = [
                'message' => 'Unauthorized'
            ];
    
     // Assert the response should always have a 'message' key
        // Assert that the message is 'Unauthorized'
     $this->assertArrayHasKey('message', $response, "Expected 'message' key in response");
     $this->assertEquals($expectedResponse['message'], $response['message'], "Expected 'Unauthorized' message in response");
}

public function testVerifyInvalidToken()
    {
        // Valid API key and token (replace with actual valid credentials)
        $apiKey = '00d55354-8693-4cc8-8e4e-30faf05c644e';
        $token = 'token';
        
        // Create a new instance of Verify
        $verify = new Verify();

        // Call the verify method with valid credentials
        $response = $verify->verify($apiKey, $token);

        // Log the response to the terminal for inspection
        echo "Valid API Response: ";
        print_r($response);

        $expectedResponse = ['code' => 400, 'message' => 'Invalid token'];
        $this->assertArrayHasKey('code', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals($expectedResponse['code'], $response['code']);
        $this->assertEquals($expectedResponse['message'], $response['message']);
    }

//     private function mockCurlFunctions($response, $httpCode)
// {
//     $curlInitMock = $this->getFunctionMock('App\Verify', 'curl_init');
//     $curlInitMock->expects($this->once())->willReturn('mock_curl');

//     $curlSetoptMock = $this->getFunctionMock('App\Verify', 'curl_setopt');
//     $curlSetoptMock->expects($this->any())->willReturn(true);

//     $curlExecMock = $this->getFunctionMock('App\Verify', 'curl_exec');
//     $curlExecMock->expects($this->once())->willReturn($response);

//     $curlGetinfoMock = $this->getFunctionMock('App\Verify', 'curl_getinfo');
//     $curlGetinfoMock->expects($this->once())->willReturn($httpCode);

//     $curlErrnoMock = $this->getFunctionMock('App\Verify', 'curl_errno');
//     $curlErrnoMock->expects($this->once())->willReturn(0);

//     $curlErrorMock = $this->getFunctionMock('App\Verify', 'curl_error');
//     $curlErrorMock->expects($this->once())->willReturn('');
// }
    
}