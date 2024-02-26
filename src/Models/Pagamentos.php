<?php
namespace App\Models;
class Pagamentos {
    
    private $id;
    private $datapagamento;
    private $valorpago;
    private $venda;
    private $crediario;
    
    function __construct($id=null, $datapagamento=null,$valorpago=null) {
        $this->id = $id;
        $this->datapagamento = $datapagamento;
        $this->valorpago=$valorpago;
        $this->venda = [];
        $this->crediario = [];
    }
    
    function get($atributo){
        return $this->$atributo;
    }

    function set($atributo, $valor){
        $this->$atributo = $valor;
    }

    
    function setVenda($id){
        $this->venda[] = new Venda($id);
    }

    function setCrediario($id){
        $this->crediario[] = new Crediario($id);
    }

    function atributos($preenchidos = false){
        if (!$preenchidos) return array_keys(get_object_vars($this));

        return array_keys(array_filter(get_object_vars($this), function($value){ return $value != '';}));
    }    
}