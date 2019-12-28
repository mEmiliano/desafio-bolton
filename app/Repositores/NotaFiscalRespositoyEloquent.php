<?php


namespace App\Repositores;

use App\Repositores\NotaFiscalRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\NotaFiscal;

class NotaFiscalRespositoyEloquent implements NotaFiscalRepositoryInterface
{
    private $modelNotafiscal;

    public function __construct(NotaFiscal $modelNotafiscal)
    {
        $this->modelNotafiscal = $modelNotafiscal;
    }

    public function get($chaveAcesso)
    {
        return $this->modelNotafiscal::where('chave_acesso', $chaveAcesso)->firstOrFail();
    }

    public function getAll()
    {
        return $this->modelNotafiscal->all(['chave_acesso']);
    }

    public function getFirst($chaveAcesso)
    {
        return $this->modelNotafiscal::where('chave_acesso', $chaveAcesso)->first();
    }

    public function save()
    {
        $this->modelNotafiscal->save();
    }
}
