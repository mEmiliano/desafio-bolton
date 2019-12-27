<?php


namespace App\Repositores;

use Illuminate\Http\Request;

interface NotaFiscalRepositoryInterface
{
    public function post(Request $request);
    public function getAll();
    public function get($chaveAcesso);
}
