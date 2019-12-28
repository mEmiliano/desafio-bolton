<?php


namespace App\Repositores;

use Illuminate\Http\Request;

interface NotaFiscalRepositoryInterface
{
    public function getFirst($chaveAcesso);
    public function save();
    public function getAll();
    public function get($chaveAcesso);
}
