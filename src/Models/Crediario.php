<?php
namespace App\Models;

class Crediario {

private $id;
private $datapagamento;
private $estatus;
private $cliente;
private $venda;
private $parcelaspagas;


public function __construct($id = null, $datapagamento = null, $estatus = null, $cliente = null, $venda = null, $parcelaspagas = null) {
    $this->id = $id;
    $this->datapagamento = $datapagamento;
    $this->estatus = $estatus;
    $this->cliente = $cliente;
    $this->venda = $venda;
    $this->parcelaspagas = $parcelaspagas;
}
function get($atributo){
    return $this->$atributo;
}

function set($atributo, $valor){
    $this->$atributo = $valor;
}


function setCliente($id){
    $this->cliente[] = new Cliente($id);
}

function setVenda($id){
    $this->venda[] = new Venda($id);
}

function atributos($preenchidos = false){
    if (!$preenchidos) return array_keys(get_object_vars($this));

    return array_keys(array_filter(get_object_vars($this), function($value){ return $value != '';}));
}

}
?>