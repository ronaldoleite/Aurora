<?php
namespace App\Models;

class Produto {

    private $id;
    private $codigo;
    private $datacadastro;
    private $nome;
    private $descricao;
    private $quantidade;
    private $cor;
    private $preco;
    private $desconto;
    private $imagem;
    private $categoria;
    private $estatus;
    private $fornecedor;
    private $precodecusto;
    // private $estoque;    

    function __construct($id = NULL, $codigo = NULL, $datacadastro = null, $nome = NULL, $descricao = NULL, $quantidade = NULL, $cor = NULL, $preco = NULL, $desconto = NULL, $imagem = NULL,  $estatus = NULL,$precodecusto = null) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->datacadastro = $datacadastro;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->quantidade = $quantidade;
        $this->cor = $cor;
        $this->preco = $preco;
        $this->desconto = $desconto;
        $this->imagem = $imagem;
        $this->categoria = [];        
        $this->fornecedor = [];
        $this->estatus = $estatus;
        $this->precodecusto = $precodecusto;
    }

    function get($atributo){
        return $this->$atributo;
    }

    function set($atributo, $valor){
        $this->$atributo = $valor;
    }

    function setFornecedor($id){
        $this->fornecedor[] = new Fornecedor($id);
    }

    function setCategoria($id){
        $this->categoria[] = new Categoria($id);
    }

    function atributos($preenchidos = false){
        if (!$preenchidos) return array_keys(get_object_vars($this));

        return array_keys(array_filter(get_object_vars($this), function($value){ return $value != '';}));
    }
}