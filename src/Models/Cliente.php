<?php
namespace App\Models;
class Cliente
{
    private $id;
    private $codigo;
    private $nome;
    private $cpf;
    private $rg;
    private $cidade;
    private $logradouro;
    private $numero;
    private $bairro;
    private $cep;
    private $uf;
    private $telefone;
    private $celular;
    private $sexo;
    private $ativo;
    private $nomemae;
    private $empregoatual;
    private $renda;
    private $limite;

    function __construct($id = null, $codigo = null, $nome = null, $cpf = null, $rg = null, $cidade = null, $logradouro = null, $numero = null, $bairro = null, $cep = null, $uf = null, $telefone = null, $celular = null, $sexo = null, $ativo = null, $mae = null, $emprego = null, $renda = null, $limite = null)
    {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->rg = $rg;
        $this->cidade = $cidade;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cep = $cep;
        $this->telefone = $telefone;
        $this->celular = $celular;
        $this->sexo = $sexo;
        $this->ativo = $ativo;
        $this->uf = $uf;
        $this->nomemae = $mae;
        $this->empregoatual = $emprego;
        $this->renda = $renda;
        $this->limite = $limite;
    }

    function getId(){
        return $this->id;
    }

    function get($atributo)
    {
        return $this->$atributo;
    }

    function set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    function atributos($preenchidos = false)
    {
        if (!$preenchidos) return array_keys(get_object_vars($this));

        return array_keys(array_filter(get_object_vars($this), function ($value) {
            return $value != '';
        }));
    }
}
