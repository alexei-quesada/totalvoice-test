<?php

namespace App;

use App\HttpClient;

class UnitTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var HttpClient
     */

    private $httpClient;

    protected function setUp()
    {
        $this->httpClient = new HttpClient();
    }

    /**
     * @test
     */
    public function testHttpClientInstance()
    {
        $this->assertInstanceOf(HttpClient::class, $this->httpClient);
    }

    /**
     * @test
     */
    public function constructShouldConfigureApiUri()
    {
        $this->assertAttributeSame('api.totalvoice.com.br', 'base_uri', $this->httpClient);
    }

    /**
     * @test
     */
    public function setAccessTokenShouldConfigureAttribute()
    {
        $this->httpClient->setAccessToken('91a6d7c2d247275ce08b4707be6de050');
        $this->assertAttributeSame('91a6d7c2d247275ce08b4707be6de050', 'access_token', $this->httpClient);
    }

    /**
     * @test
     */
    public function testHttpClientExpectedResponseWhenNullEndpointParameter()
    {
        $response = $this->httpClient->executeRequest(null, 'GET', []);
        $this->assertTrue($response['hasError']);
        $this->assertSame('Deve fornecer um endpoint válido', $response['errorMessage']);
    }

    /**
     * @test
     */
    public function testHttpClientExpectedResponseWhenInvalidEndpointParameter()
    {
        $response = $this->httpClient->executeRequest('asd', 'GET', []);
        $this->assertTrue($response['hasError']);
        $this->assertSame('Deve fornecer um endpoint válido', $response['errorMessage']);
    }

}
