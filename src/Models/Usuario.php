<?php

namespace App\Models;

class Usuario
{
    private $id;
    private $nome;
    private $usuario;
    private $senha;
    private $perfil;
    private $email;
    private $imagem;
    private $ativo;

    function __construct($id = null, $nomeUsuario = null, $usuario = null, $senha = null, $email = null, $imagem = null, $ativo = null) {
        $this->id = $id;
        $this->nome = $nomeUsuario;
        $this->usuario = $usuario;
        $this->senha = $senha;
        $this->perfil = [];
        $this->email = $email;
        $this->imagem = $imagem;
        $this->ativo = $ativo;
    }

    function getId(){
        return $this->id;
    }
    function get($atributo){
        return $this->$atributo;
    }

    function set($atributo, $valor){
        $this->$atributo = $valor;
    }

    function setPerfil($descricao){
        $this->perfil[] = new Perfil(null, $descricao);
    }

    function atributos($preenchidos = false){
        if (!$preenchidos) return array_keys(get_object_vars($this));

        return array_keys(array_filter(get_object_vars($this), function($value){ return $value != '';}));
    }
}
