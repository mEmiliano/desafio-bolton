<?php


namespace App\Repositores;

use App\Repositores\NotaFiscalRepositoryInterface;
use Illuminate\Http\Request;

class NotaFiscalRespositoyEloquent implements NotaFiscalRepositoryInterface
{
    private $modelNotafiscal;
    public function __construct(ModelNotaFiscal $modelNotafiscal)
    {
        $this->modelNotafiscal = $modelNotafiscal;
    }

    public function post(Request $request)
    {
        return $this->modelNotafiscal->create($request->all());
    }

    public function get($chaveAcesso)
    {
        return $this->modelNotafiscal->find($chaveAcesso);
    }

    public function getAll()
    {
        return $this->modelNotafiscal->all();
    }
}
