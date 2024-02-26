<?php

namespace App\Models;

class PerfilDao extends Contexto
{
    function __construct() {
        parent::__construct();
    }

    public function listar(){
        return $this->ObterTodos('PERFIL');
    }
}
