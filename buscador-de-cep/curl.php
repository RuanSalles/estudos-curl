<?php

/**
 * @return array
 * @throws JsonException
 */
function getResponse(): array
{
    $curl = curl_init();

    $cep = filter_var($_POST['cep'], FILTER_SANITIZE_STRING);
    $url = "https://viacep.com.br/ws/{$cep}/json/";

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response, true, 512, JSON_THROW_ON_ERROR);

}

try {
    $response = getResponse();
} catch (JsonException $e) {
    echo " <div class='container'> 
       <p class='text-center alert-danger'> {$e->getMessage()}  </p> 
        </div> ";
}

