<?php
namespace App\Models;
use PDO;
use PDOException;
class ClienteDao extends Contexto
{
    function __construct()
    {
        parent::__construct();
    }

    // Este método lista todos os usuários cadastrados no banco de dados
    public function Listar()
    {
        return $this->ObterTodos('CLIENTES');
    }

    // Este método lista apenas um usuario no banco de dados
    public function ObterUm($id)
    {
        return $this->ObterPorId('CLIENTES',$id);
    }

    // Este método adiciona um novo usuario no banco de dados
    function Adicionar($cliente)
    {
        return $this->insert('CLIENTES', $cliente);
    }

    // Este método altera os dados de um usuários cadastrados no banco de dados
    function Alterar($cliente)
    {
        return $this->update('CLIENTES', $cliente);
    }

    // Este método exclui um usuários cadastrados no banco de dados
    function Deletar($cliente)
    {
        return $this->delete('CLIENTES', $cliente);
    }

    function UltimoCodigo(){
        return $this->UltimoRegistro('CLIENTES','CODIGO'); 
    }
}
?>