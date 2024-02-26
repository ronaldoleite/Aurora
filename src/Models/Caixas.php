<?php
namespace App\Models;
class Caixas {
    private $id;
    private $valorfinal;
    private $usuario;
    private $caixa;
    private $datafechamento;
    
    public function __construct($id=null, $valorfinal=null,  $datafechamento=null) {
        $this->id = $id;
        $this->valorfinal = $valorfinal;
        $this->usuario = [];
        $this->caixa = [];
        $this->datafechamento = $datafechamento;
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

    function setCaixa($id){
        $this->caixa[] = new Caixa($id);
    }

    function atributos($preenchidos = false){
        if (!$preenchidos) return array_keys(get_object_vars($this));

        return array_keys(array_filter(get_object_vars($this), function($value){ return $value != '';}));
    }
}
