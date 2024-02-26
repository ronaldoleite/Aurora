<?php
namespace App\Models;
class ItensVenda
{
    private $id;
    private $venda;
    private $produto;
    private $quantidade;
    private $itve_venda;
    private $precounitario;

    function __construct($id = null, $venda = null, $produto = null, $quantidade = null, $itve_venda = null,$precounitario = null)
    {
        $this->id = $id;
        $this->venda = $venda;
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->itve_venda = $itve_venda;
        $this->precounitario = $precounitario;
    }
    function getid()
    {
        return $this->id;
    }

    function getVenda()
    {
        return $this->venda;
    }

    function getProduto()
    {
        return $this->produto;
    }

    function getQuantidade()
    {
        return $this->quantidade;
    }

    function getItve_venda()
    {
        return $this->itve_venda;
    }

    function getPrecounitario()
    {
        return $this->precounitario;
    }

    function setid($id)
    {
        $this->id = $id;
    }

    function setVenda($venda)
    {
        $this->venda = $venda;
    }

    function setProduto($produto)
    {
        $this->produto = $produto;
    }

    function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    function setItve_venda($itve_venda)
    {
        $this->itve_venda = $itve_venda;
    }

    function setPrecounitario($precounitario)
    {
        $this->precounitario = $precounitario;
    }
}

?>