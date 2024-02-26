<?php
namespace App\Models;
class EstabelecimentoDao extends Contexto
{
    function __construct()
    {
        parent::__construct();
    }

    // Este método lista todos os usuários cadastrados no banco de dados
    public function Listar()
    {
        return $this->ObterTodos('ESTABELECIMENTO');
    }

    // Este método lista apenas um usuario no banco de dados
    public function ObterUm($id)
    {
        return $this->ObterPorId('ESTABELECIMENTO',$id);
    }

    // Este método adiciona um novo usuario no banco de dados
    function Adicionar($estabelecimento)
    {
        return $this->insert('ESTABELECIMENTO', $estabelecimento);
    }

    // Este método altera os dados de um usuários cadastrados no banco de dados
    function Alterar($estabelecimento)
    {
        return $this->update('ESTABELECIMENTO', $estabelecimento);
    }

    // Este método exclui um usuários cadastrados no banco de dados
    function Deletar($estabelecimento)
    {
        return $this->delete('ESTABELECIMENTO', $estabelecimento);
    }
}
?>