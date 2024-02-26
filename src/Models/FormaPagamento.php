<?php

namespace App\Models;

class FormaPagamento {

    private $id;
    private $descricao;

    function __construct($id = null, $descricao = null) {
        $this->id = $id;
        $this->descricao = $descricao;
    }

    function getId() {
        return $this->id;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setIdfopa($id) {
        $this->id = $id;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}
