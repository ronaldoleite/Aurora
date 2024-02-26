<?php 
namespace App\Models;
class Venda {
    private $id;
    private $dataVenda;
    private $valor;
    private $usuario;
    private $cliente;
    private $forPag;
    private $qtdeIt;
    private $parcela;
    private $itensVenda;

    function __construct($id = null, $dataVenda = null, $valor = null, $usuario = null, $cliente = null, $forPag = null, $qtdeIt = null, $parcela = null) {
        $this->id = $id;
        $this->dataVenda = $dataVenda;
        $this->valor = $valor;
        $this->usuario = $usuario;
        $this->cliente = $cliente;
        $this->forPag = $forPag;
        $this->qtdeIt = $qtdeIt;
        $this->parcela = $parcela;
        $this->itensVenda = [];
    }

    function getId() {
        return $this->id;
    }

    function getDataVenda() {
        return $this->dataVenda;
    }

    function getValor() {
        return $this->valor;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getForPag() {
        return $this->forPag;
    }
    public function getQtdeIt() {
        return $this->qtdeIt;
    }
    
    public function getParcela() {
        return $this->parcela;
    }

    public function setParcela($parcela) {
        $this->parcela = $parcela;
    }

    
    public function setQtdeIt($qtdeIt) {
        $this->qtdeIt = $qtdeIt;
    }

    
    function setId($id) {
        $this->id = $id;
    }

    function setDataVenda($dataVenda) {
        $this->dataVenda = $dataVenda;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    function setForPag($forPag) {
        $this->forPag = $forPag;
    }

    function setItensVenda($id=null, $venda=null, $produto=null, $quantidade=null, $itve_venda=null, $precounitario=null) {
        $this->itensVenda[] = new ItensVenda($id, $venda, $produto, $quantidade, $itve_venda, $precounitario);
    }
    
    function getItensVenda() {
        return $this->itensVenda;
    }
}