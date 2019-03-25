<?php

namespace App;

class HttpClient
{

    // const BASE_URI = 'api.totalvoice.com.br';

    private $access_token;
    private $base_uri;

    public function __construct()
    {
        $this->base_uri = 'api.totalvoice.com.br';
    }

    public function getAccessToken()
    {
        return $this->access_token;
    }

    public function setAccessToken($accessToken)
    {
        $this->access_token = $accessToken;
    }

    public function getBaseUri()
    {
        return $this->base_uri;
    }

    public function setBaseUri($baseUri)
    {
        $this->base_uri = $baseUri;
    }

    //função para consultar o endpoint pelo método POST
    public function executeRequest($endpoint, $requestType, $parameters)
    {

        if (!isset($endpoint) || ($endpoint != 'status' && $endpoint != 'bina' && $endpoint != 'saldo')) {
            return array(
                'hasError' => true,
                'errorMessage' => 'Deve fornecer um endpoint válido',
                'headers' => '',
                'body' => '',
            );
        }

        //Abrir um socket no host TotalVoice
        $socket = fsockopen($this->base_uri, 80, $errno, $errstr, 30);
        if (!$socket) {
            return array(
                'hasError' => true,
                'errorMessage' => $errstr,
                'headers' => '',
                'body' => $errno,
            );
        } else {
            //construir a requisiçao http
            $request = $this->buildHttpRequest($requestType, $endpoint, $parameters);
            fwrite($socket, $request);

            //caso seja o método POST, adicionar os parâmetros ao corpo da requisiçao http
            if ($requestType == 'POST') {
                fwrite($socket, json_encode($parameters));
            }
            $response = "";

            //obter a resposta da API
            while (!feof($socket)) {
                $response .= fgets($socket);
            }
            //fechar a conexão
            fclose($socket);

            list($header, $body) = preg_split("/\R\R/", $response, 2);

            //codifica o corpo da resposta en JSON
            $body = json_decode($body);

            return array(
                'hasError' => false,
                'errorMessage' => '',
                'headers' => $header,
                'body' => $body,
            );
        }

    }

    //função auxiliar para construir a requisiçao http
    private function buildHttpRequest($requestType, $endpoint, $postdata)
    {

        $postdata = json_encode($postdata);

        $request = $requestType . " /" . $endpoint . " HTTP/1.1\r\n";
        $request .= "Host: " . $this->base_uri . "\r\n";
        $request .= "Content-Type: application/json\r\n";
        $request .= ($requestType == 'POST') ? "Content-Length: " . strlen($postdata) . "\r\n" : '';
        $request .= "Access-Token: " . $this->access_token . "\r\n";
        $request .= "Connection: Close\r\n\r\n";
        $request .= $postdata . "\r\n\r\n";

        return $request;
    }

}
