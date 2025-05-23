<?php

use Pecee\SimpleRouter\SimpleRouter;
use sistema\Nucleo\Helpers;

try {
    //namespace dos controladores
    SimpleRouter::setDefaultNamespace('sistema\Controller');

    //SITE
    SimpleRouter::get(URL_SITE, 'SiteController@index');
    SimpleRouter::match(['get', 'post'], URL_SITE . 'login', 'SiteController@login');
    SimpleRouter::match(['get', 'post'], URL_SITE . 'home', 'SiteController@home');
    SimpleRouter::match(['get', 'post'], URL_SITE . 'pesquisa', 'SiteController@pesquisa');
    SimpleRouter::match(['get', 'post'], URL_SITE . 'artigos', 'SiteController@artigos');
    SimpleRouter::match(['get', 'post'], URL_SITE . 'sobre', 'SiteController@sobre');
    SimpleRouter::match(['get', 'post'], URL_SITE . 'voluntarios', 'SiteController@voluntarios');
    SimpleRouter::match(['get', 'post'], URL_SITE . 'redefinirSenha', 'SiteController@redefinirSenha');
    SimpleRouter::get(URL_SITE . '404', 'SiteController@erro404');

    //ROTAS ADMIN
    SimpleRouter::group(['namespace' => 'Admin'], function () {

        //ADMIN LOGIN
        SimpleRouter::get(URL_ADMIN, 'AdminLogin@index');
        SimpleRouter::get(URL_SITE, 'AdminLogin@index');

        //DASHBOAD
        SimpleRouter::get(URL_ADMIN . 'dashboard', 'AdminDashboard@dashboard');
        SimpleRouter::get(URL_ADMIN . 'sair', 'AdminDashboard@sair');

        //ADMIN USUARIOS
           SimpleRouter::get(URL_ADMIN . 'usuarios/listar', 'AdminUsuarios@listar');
        // SimpleRouter::match(['get', 'post'], URL_ADMIN . 'usuarios/cadastrar', 'AdminUsuarios@cadastrar');
        
        
    });
    SimpleRouter::start();
} catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $ex) {
    if (Helpers::localhost()) {
        echo $ex->getMessage();
    } else {
        Helpers::redirecionar('404');
    }
}
