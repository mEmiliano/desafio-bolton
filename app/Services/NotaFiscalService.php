<?php

namespace App\Services;

use App\Repositores\NotaFiscalRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class NotaFiscalService
{
    private $notaFiscalRepository;

    public function __construct(NotaFiscalRepositoryInterface $notaFiscalRepository)
    {
        $this->notaFiscalRepository = $notaFiscalRepository;
    }

    public function save()
    {
        //implementation
    }

    public function getAll()
    {
        $notasFiscais = $this->notaFiscalRepository->getAll();
    }

    public function get($chaveAcesso)
    {
        return $this->notaFiscalRepository->get($chaveAcesso);
    }
}
