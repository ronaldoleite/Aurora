<?php
namespace App\Models;

 class Fornecedor {
    private $id;
    private $nome;
    private $razaosocial;
    private $cidade;
    private $bairro;
    private $logradouro;
    private $contato;
    private $email;
    private $cep;
    private $uf;
    
    public function __construct($id=null, $nome=null, $razaosocial=null, $cidade=null, $bairro=null, $logradouro=null, $contato=null, $email=null,$cep = null,$uf=null) {
        $this->id = $id;
        $this->nome = $nome;
        $this->razaosocial = $razaosocial;
        $this->cidade = $cidade;
        $this->bairro = $bairro;
        $this->logradouro = $logradouro;
        $this->contato = $contato;
        $this->email = $email;
        $this->cep = $cep;
        $this->uf = $uf;        
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

?>