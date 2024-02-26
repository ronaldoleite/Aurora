<?php
namespace App\Models;
use PDO;
use PDOException;
class FornecedorDao extends Contexto
{
    function __construct()
    {
        parent::__construct();
    }

    // Este método lista todos os usuários cadastrados no banco de dados
    public function Listar()
    {
        return $this->ObterTodos('FORNECEDOR');
    }

    // Este método lista apenas um usuario no banco de dados
    public function ObterUm($id)
    {
        return $this->ObterPorId('FORNECEDOR',$id);
    }

    // Este método adiciona um novo usuario no banco de dados
    function Adicionar($fornecedor)
    {
        return $this->insert('FORNECEDOR', $fornecedor);
    }

    // Este método altera os dados de um usuários cadastrados no banco de dados
    function Alterar($fornecedor)
    {
        return $this->update('FORNECEDOR', $fornecedor);
    }

    // Este método exclui um usuários cadastrados no banco de dados
    function Deletar($fornecedor)
    {
        return $this->delete('FORNECEDOR', $fornecedor);
    }
}
?>