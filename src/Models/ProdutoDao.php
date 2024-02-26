<?php

namespace App\Models;
use PDO;
use PDOException;

class ProdutoDao extends Contexto
{
    function __construct()
    {
        parent::__construct();
    }

    // Este método lista todos os usuários cadastrados no banco de dados
    public function Listar()
    {
        return $this->ObterTodos('PRODUTO');
    }

    // Este método lista apenas um usuario no banco de dados
    public function ObterUm($id)
    {
        return $this->ObterPorId('PRODUTO',$id);
    }

     // Este método lista apenas um usuario no banco de dados
     public function ObterComCodigo($codigo)
     {
         return $this->ObterPorCodigo('PRODUTO',$codigo);
     }

    // Este método adiciona um novo usuario no banco de dados
    function Adicionar($produto)
    {
        return $this->insert('PRODUTO', $produto);
    }

    // Este método altera os dados de um usuários cadastrados no banco de dados
    function Alterar($produto)
    {
        return $this->update('PRODUTO', $produto);
    }

    // Este método exclui um usuários cadastrados no banco de dados
    function Deletar($produto)
    {
        return $this->delete('PRODUTO', $produto);
    }

    function UltimoCodigo(){
        return $this->UltimoRegistro('PRODUTO','CODIGO'); 
    }

    public function AtivarProduto($valor, $id) {

        $sql = "UPDATE PRODUTO SET ESTATUS = '{$valor}' WHERE ID = '{$id}' ";
        try {
            $stmt = $this->banco->prepare($sql);
            $ret = $stmt->execute();
            $this->banco = null;
            if (!$ret) {
                die("Erro ao alterar o status do produto");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
?>