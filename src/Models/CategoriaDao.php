<?php

namespace App\Models;
use PDO;
use PDOException;

class CategoriaDao extends Contexto
{
    function __construct()
    {
        parent::__construct();
    }

    // Este método lista todos os usuários cadastrados no banco de dados
    public function Listar()
    {
        return $this->ObterTodos('CATEGORIA');
    }

    // Este método lista apenas um usuario no banco de dados
    public function ObterUm($id)
    {
        return $this->ObterPorId('CATEGORIA',$id);
    }

    // Este método adiciona um novo usuario no banco de dados
    function Adicionar($categoria)
    {
        return $this->insert('CATEGORIA', $categoria);
    }

    // Este método altera os dados de um usuários cadastrados no banco de dados
    function Alterar($categoria)
    {
        return $this->update('CATEGORIA', $categoria);
    }

    // Este método exclui um usuários cadastrados no banco de dados
    function Deletar($categoria)
    {
        return $this->delete('CATEGORIA', $categoria);
    }
}
?>