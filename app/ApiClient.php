<?php

namespace App;

use App\Exceptions\ApiClientArquiveiException;
use App\Exceptions\ApiClientArquiveiResponseStructureException;
use App\Services\ApiClient\ApiClientArquivei\ReceiveNfeResponse;
use App\Services\ApiClient\ApiClientArquivei\ReceiveNfeResponseFactory;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

class ApiClient
{
    private $uri;
    private $options;

    public function __construct()
    {
        $this->variaveisAmbiente();
    }

    private function variaveisAmbiente()
    {
        $uriVazia = empty(env('URI_ARQUIVEI')) == true;
        $xApiIdVazia = empty(env('X_API_ID')) == true;
        $xApiKeyVazia = empty(env('X_API_KEY')) == true;

        if ($uriVazia || $xApiIdVazia || $xApiKeyVazia) {
            throw new \Exception('Variáveis de ambiente estão incorretas/faltando');
        }

        $headers = ['Content-Type' => 'application/json', 'x-api-id' => env('X_API_ID'), 'x-api-key' => env('X_API_KEY')];
        $this->uri = env('URI_ARQUIVEI');
        $this->options = ['http_errors' => false, 'headers' => $headers];
    }

    public function buscarNotasFiscaisArquivei()
    {
        $client = new Client(['base_uri' => $this->uri]);
        $response = $client->get('nfe/received', $this->options);
        $jsonResponse = json_decode($response->getBody()->getContents());

        if ($jsonResponse->status->code !== Response::HTTP_OK) {
            throw new \Exception('Problemas com resposta da API Arquivei');
        }

        return $jsonResponse;
    }
}
