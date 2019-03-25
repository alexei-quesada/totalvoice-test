<?php

require "../vendor/autoload.php";

use App\HttpClient;

//valida que há um token de acesso válido
if (!isset($_POST['accessToken']) || empty($_POST['accessToken'])) {
    echo "Deve fornecer o token de acesso";
}

//valida que há um endpoint válido
else if (!isset($_POST['endpoint']) || empty($_POST['endpoint']) || $_POST['endpoint'] == "-1") {
    echo "Deve fornecer um endpoint válido";
} else {
    //capturar os parâmetros do POST
    $accessToken = $_POST['accessToken'];
    $endPoint = $_POST['endpoint'];

    //inicializar o cliente http e adicionar o token de acesso
    $client = new HttpClient();
    $client->setAccessToken($accessToken);

    $response = '';

    //saber qual endpoint se deseja consultar para seguir a lógica correspondente
    switch ($endPoint) {

        //se for o endpoint Bina, deve-se obter o parâmetro de telefone
        case "bina":

            //valida que há um telefone válido
            if (!isset($_POST['telefone']) || empty($_POST['telefone'])) {
                echo "Você deve fornecer um numero de telefone válido";
            } else {
                //obter o parâmetro telefone e consultar a API
                $telefone = $_POST['telefone'];
                $response = $client->executeRequest("bina", "POST", array('telefone' => $telefone));
            }
            break;
        default:
            //os outros 2 endpoint ativados têm o mesmo comportamento
            $response = $client->executeRequest($endPoint, "GET", []);
    }

    //se houver um erro, mostrará a mensagem ou, caso contrário, retornará o corpo da resposta da API
    if ($response['hasError']) {
        echo $response['errorMessage'];
    } else {
        echo json_encode($response['body']);
    }
}
