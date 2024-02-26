<?php

namespace App\Models;
use PDO;
use PDOException;

class PagamentoDao extends Contexto
{

    function __construct()
    {
        parent::__construct();
    }

    function Adicionar($pagamento)
    {
        $this->insert("PAGAMENTOS",$pagamento);
    }

    function ObterPagamento()
    {
        $this->ObterTodos("PAGAMENTOS");
    }

    function ObterPagamentoPorId($id)
    {
        $this->ObterPorId("PAGAMENTOS",$id);
    }

    function Atualizar($pagamento)
    {
        $this->update("PAGAMENTOS",$pagamento);
    }

    function excluir($id)
    {
        $this->delete("PAGAMENTOS",$id);
    }
}