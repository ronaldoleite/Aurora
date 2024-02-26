<?php

namespace App\Models;
class Caixa {
    private $id;
    private $valorinicial;
    private $valorfinal;
    private $usuario;
    private $dataabertura;
    
    public function __construct($id=null, $valorinicial=null, $valorfinal=null, $dataabertura=null) {
        $this->id = $id;
        $this->valorinicial = $valorinicial;
        $this->valorfinal = $valorfinal;
        $this->usuario = [];
        $this->dataabertura = $dataabertura;
    }
    function get($atributo){
        return $this->$atributo;
    }

    function set($atributo, $valor){
        $this->$atributo = $valor;
    }

    function setUsuario($id){
        $this->usuario[] = new Usuario($id);
    }

    function atributos($preenchidos = false){
        if (!$preenchidos) return array_keys(get_object_vars($this));

        return array_keys(array_filter(get_object_vars($this), function($value){ return $value != '';}));
    }
}
