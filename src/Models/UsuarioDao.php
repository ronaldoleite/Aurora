<?php

namespace App\Models;
use PDO;
use PDOException;

class UsuarioDao extends Contexto
{
    function __construct()
    {
        parent::__construct();
    }

    // Este método lista todos os usuários cadastrados no banco de dados
    public function ListarTodos()
    {
        return $this->ObterTodos('USUARIO');
    }

    // Este método lista apenas um usuario no banco de dados
    public function ObterUm($id)
    {
        return $this->ObterPorId('USUARIO',$id);
    }

    // Este método adiciona um novo usuario no banco de dados
    function Adicionar($usuario)
    {
        return $this->insert('USUARIO', $usuario);
    }

    // Este método altera os dados de um usuários cadastrados no banco de dados
    function alterar($usuario)
    {
        return $this->update('USUARIO', $usuario);
    }

    // Este método exclui um usuários cadastrados no banco de dados
    function deletar($usuario)
    {
        return $this->delete('USUARIO', $usuario);
    }

    // Este método valida no banco de dados se o usuário tem acesso a aplicação
    function autenticar($usuario)
    {
        $sql = "SELECT ID, NOME, IMAGEM, PERFIL, SENHA FROM USUARIO WHERE USUARIO = ? ";
        try {
            $l = $this->banco->prepare($sql);
            $l->bindValue(1, $usuario);
            #$l->bindValue(2, $usuario->getSenha());
            $retorna = $l->execute();
            $this->banco = null;
            if (!$retorna) {
                die("Erro ao autenticar no banco !");
            } else {
                $resultado = $l->fetchAll(PDO::FETCH_OBJ);
                return $resultado;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
