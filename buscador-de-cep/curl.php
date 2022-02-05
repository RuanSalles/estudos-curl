<?php

/**
 * @return array
 * @throws JsonException
 * @throws Exception
 */
function getResponse(): array
{
    $curl = curl_init();

    $cep = filter_var($_POST['cep'], FILTER_SANITIZE_STRING);

    if($cep === '') {
        throw new Exception('Valor não passado, verifique os dados', '404' );
    }
    $url = "https://viacep.com.br/ws/{$cep}/json/";

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);

    curl_close($curl);
    return json_decode($response, true);

}

try {
    $response = getResponse();
} catch (Exception $e) {
    echo " <div class='container'> 
       <p class='text-center alert-danger'> {$e->getMessage()}  </p> 
        </div> ";
}

