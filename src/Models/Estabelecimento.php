<?php
 namespace App\Models;

class Estabelecimento {

    private $id; 
    private $nome; 
    private $logradouro; 
    private $numero; 
    private $bairro; 
    private $cidade; 
    private $cep; 
    private $uf; 
    private $telefone; 
    private $cnpj; 
    private $ie; 
    private $logo;
       
    
            function __construct($id=null, $nome=null, $logradouro=null,$numero=null, $bairro=null, $cidade=null, $cep=null, $uf=null, $telefone=null, $cnpj=null, $ie=null,$logo=null) {
            $this->id = $id;
            $this->nome = $nome;
            $this->logradouro = $logradouro;
            $this->numero = $numero;
            $this->bairro = $bairro;
            $this->cidade = $cidade;
            $this->cep = $cep;
            $this->uf = $uf;
            $this->telefone = $telefone;
            $this->cnpj = $cnpj;
            $this->ie = $ie;
            $this->logo = $logo;
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