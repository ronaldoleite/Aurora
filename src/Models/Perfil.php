<?php

namespace App\Models;

class Perfil
{
    private $idperfil;
    private $descricao;
    
    function __construct($idperfil = null, $descricao=null) {
        $this->idperfil = $idperfil;
        $this->descricao = $descricao;
    }
    function getIdperfil() {
        return $this->idperfil;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setIdperfil($idperfil) {
        $this->idperfil = $idperfil;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }
}
