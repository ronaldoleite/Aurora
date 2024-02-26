<?php
namespace App\Models;
class Categoria {
    
    private $id;
    private $descricao;
    private $estatus;
    
    function __construct($id=null, $descricao=null,$estatus=null) {
        $this->id = $id;
        $this->descricao = $descricao;
        $this->estatus=$estatus;
    }
    
    function get($atributo){
        return $this->$atributo;
    }

    function set($atributo, $valor){
        $this->$atributo = $valor;
    }

    function atributos($preenchidos = false){
        if (!$preenchidos) return array_keys(get_object_vars($this));

        return array_keys(array_filter(get_object_vars($this), function($value){ return $value != '';}));
    }    
}