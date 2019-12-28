<?php

namespace App\Http\Controllers;

use App\Services\NotaFiscalService;
use Illuminate\Http\Response;

class NotaFiscalController
{
    private $notaFiscalService;

    public function __construct(NotaFiscalService $notaFiscalService)
    {
        $this->notaFiscalService = $notaFiscalService;
    }

    /**
     * @OA\Post(
     *     path="/nota-fiscal/salvar",
     *     operationId="/nota-fiscal/salvar",
     *     tags={"Nota Fiscal"},
     *     @OA\Response(
     *         response="204",
     *         description="Notas fiscais com sucesso"
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="Erro com o cliente"
     *     ),
     *     @OA\Response(
     *         response="422",
     *         description="Erro ao tentar converter alguma estrutura ou algo em salvar alguma nota fiscal"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Erro com o servidor"
     *     ),
     * )
     */
    public function salvarNotasFiscais()
    {
        $this->notaFiscalService->save();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @OA\Get(
     *     path="/nota-fiscal",
     *     operationId="/nota-fiscal",
     *     tags={"Nota Fiscal - Listar Keys"},
     *     @OA\Response(
     *         response="200",
     *         description="Sucesso na buscas pelas keys"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Algo deu errado na busca das keys"
     *     ),
     * )
     */
    public function listarNotasFiscais()
    {
        return $this->notaFiscalService->getAll();
    }

    /**
     * @OA\Get(
     *     path="/nota-fiscal/{chave-acesso}",
     *     operationId="/nota-fiscal/{chave-acesso}",
     *     tags={"Nota Fiscal - Buscar por chave de acesso"},
     *     @OA\Parameter(
     *         name="chave-acesso",
     *         in="path",
     *         description="chave-acesso",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Sucesso na busca da key"
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Algo deu errado ou a key passada não é válida"
     *     ),
     * )
     * @param $chaveAcesso
     */
    public function listarPorChave($chaveAcesso)
    {
        $response =  $this->notaFiscalService->get($chaveAcesso);
        return response()->json($response->toArray());
    }
}
