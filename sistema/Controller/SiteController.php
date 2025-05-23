<?php

namespace sistema\Controller;

use sistema\Nucleo\Controller;
use sistema\Modelo\UnidadeModelo;
use sistema\Nucleo\Helpers;
use sistema\Modelo\CategoriaModelo;
use sistema\Modelo\UsuarioModelo;
use sistema\Biblioteca\Paginar;
use sistema\Suporte\Email;

class SiteController extends Controller
{

    public function __construct()
    {
        parent::__construct('templates/site/views');
    }

    /**
     * Checa se o admin existe e redireciona
     * @return void
     */
    public function index(): void
    {

        $usuario = UsuarioController::usuario();
        if ($usuario && $usuario->level == 3) {
            Helpers::redirecionar('admin/');
        } else {
            Helpers::redirecionar('home');
        }
    }

    
    public function home(): void
    {
        echo $this->template->renderizar('home.html', []);
    }

    public function pesquisa(): void
    {
        echo $this->template->renderizar('pesquisa.html', []);
    }

    public function artigos(): void
    {
        echo $this->template->renderizar('artigos.html', []);
    }

    public function sobre(): void
    {
        echo $this->template->renderizar('sobre.html', []);
    }

    public function voluntarios(): void
    {
        echo $this->template->renderizar('voluntarios.html', []);
    }

    /**
     * ERRO 404
     * @return void
     */
    public function erro404(): void
    {
        echo $this->template->renderizar('404.html', [
            'titulo' => 'Página não encontrada',
            //'categorias' => $this->categorias(),
        ]);
    }

    /**
     * Login
     * @return void
     */
    public function login(): void
    {
        $usuario = UsuarioController::usuario();
        if ($usuario) {
            switch ($usuario->tipo_usuario_id) {
                case 1: //Administração
                    Helpers::redirecionar('admin/dashboard');
                    break;
                case 2: //Central de vagas
                    Helpers::redirecionar('admin/dashboard');
                    break;
                case 3: //Unidade de acolhimento
                    Helpers::redirecionar('admin/dashboard');
                    break;
                case 4: //Centro pop
                    Helpers::redirecionar('admin/dashboard');
                    break;
                case 5: //Seas
                    Helpers::redirecionar('admin/dashboard');
                    break;
                case 6: //NOA
                    Helpers::redirecionar('admin/dashboard');
                    break;
            }
        }

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            if (in_array('', $dados)) {
                $this->mensagem->alerta('Todos os campos são obrigatórios!')->flash();
            } else {
                $usuario = (new UsuarioModelo())->login($dados, 3);
                if ($usuario) {
                    Helpers::redirecionar('login');
                }
            }
        }
// var_dump('algo');die;
        echo $this->template->renderizar('login.html', []);
    }

    public function redefinirSenha(): void
    {
        // $this->mensagem->alerta('A nova senha deve conter ao menos uma letra minúscula, uma letra maiúscula, um número, um caráter especial (.-_) e um mínimo de 6 caracteres.')->flash();
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($dados)) {
            if (Helpers::verificarNovaSenha(trim($dados['nova_senha']), trim($dados['confirmar_senha']))) {

                if (Helpers::validarSenha(trim($dados['nova_senha']))) {
                    $usuario = (new UsuarioModelo())->alterarSenha($dados);
                    if ($usuario) {
                        Helpers::redirecionar('login');
                    }
                } else {
                    $this->mensagem->erro('A nova senha não atende os requisitos mínimos.')->flash();
                }
            } else {
                $this->mensagem->alerta('A confirmação de senha não confere com a nova senha.')->flash();
            }
        }
        echo $this->template->renderizar('redefinirSenha.html', []);
    }
}
