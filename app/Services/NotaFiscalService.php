<?php

namespace App\Services;

use App\ApiClient;
use App\Models\NotaFiscal;
use App\Repositores\NotaFiscalRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use Nathanmac\Utilities\Parser\Parser;

class NotaFiscalService
{
    private $apiClient;
    private $notaFiscalRepository;

    public function __construct(NotaFiscalRepositoryInterface $notaFiscalRepository, ApiClient $apiClient)
    {
        $this->notaFiscalRepository = $notaFiscalRepository;
        $this->apiClient = $apiClient;
    }

    public function save()
    {
        $reponse = $this->apiClient->buscarNotasFiscaisArquivei();

        try {
            $this->salvarNotasFiscais($reponse);
        } catch (QueryException $ex) {
            return 'oi';
        }
    }

    private function salvarNotasFiscais($reponse)
    {
        foreach ($reponse->data as $notaFiscal) {
            $objNotaFiscal = $this->notaFiscalRepository->getFirst($notaFiscal->access_key);

            if ($objNotaFiscal == null) {
                $objNotaFiscal = new NotaFiscal();
            }

            $objNotaFiscal->chave_acesso = $notaFiscal->access_key;
            $objNotaFiscal->valor_total_nota = $this->retornaValorTotalNota($notaFiscal->xml);

            $objNotaFiscal->notaFiscalRepository->save();
        }
    }

    private function retornaValorTotalNota($xml)
    {
        $parser = new Parser();
        $parsed = $parser->xml(base64_decode($xml));

        if (isset($parsed['NFe'])) {
            return (float)$parsed['NFe']['infNFe']['total']['ICMSTot']['vNF'];
        }

        return (float)$parsed['infNFe']['total']['ICMSTot']['vNF'];
    }

    public function getAll()
    {
        return  json_encode($this->notaFiscalRepository->getAll());
    }

    public function get($chaveAcesso)
    {
        return $this->notaFiscalRepository->get($chaveAcesso);
    }
}
