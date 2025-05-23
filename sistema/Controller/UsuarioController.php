<?php

namespace sistema\Controller;

use sistema\Nucleo\Controller;
use sistema\Nucleo\Helpers;
use sistema\Nucleo\Sessao;
use sistema\Modelo\UsuarioModelo;
use sistema\Suporte\Email;

class UsuarioController extends Controller
{

    public function __construct()
    {
        parent::__construct('templates/usuario/views');
    }

    /**
     * Busca usuário pela sessão
     * @return UsuarioModelo|null
     */
    public static function usuario(): ?UsuarioModelo
    {
        $sessao = new Sessao();
        if (!$sessao->checar('usuarioId')) {
            return null;
        }

        return (new UsuarioModelo())->buscaPorId($sessao->usuarioId);
    }
}
