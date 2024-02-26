<?php
namespace App\Models;
use PDO;
use PDOException;
class CrediarioDao extends Contexto
{
    function __construct()
    {
        parent::__construct();
    }

    // Este método lista todos os usuários cadastrados no banco de dados
    public function Listar()
    {
        return $this->ObterTodos('CREDIARIO');
    }

    // Este método lista apenas um usuario no banco de dados
    public function ObterUm($id)
    {
        return $this->ObterPorId('CREDIARIO', $id);
    }

    // Este método adiciona um novo usuario no banco de dados
    function Adicionar($crediario)
    {
        return $this->insert('CREDIARIO', $crediario);
    }

    // Este método altera os dados de um usuários cadastrados no banco de dados
    function Alterar($crediario)
    {
        return $this->update('CREDIARIO', $crediario);
    }

    // Este método exclui um usuários cadastrados no banco de dados
    function Deletar($crediario)
    {
        return $this->delete('CREDIARIO', $crediario);
    }

    function ListarUmCrediario($id)
    {
        $query = "SELECT VENDA.*, CREDIARIO.ID AS CREDIARIO, VENDA.CLIENTE, CLIENTES.NOME ,
                         COALESCE(CREDIARIO.DATAPAGAMENTO,00-00-000) AS DATAPAGAMENTO ,
                         CREDIARIO.PARCELASPAGAS, CREDIARIO.ESTATUS
                  FROM VENDA INNER JOIN
                       CLIENTES ON(CLIENTES.ID = VENDA.CLIENTE)INNER JOIN 
                       CREDIARIO ON(CREDIARIO.VENDA = VENDA.ID)
                 WHERE VENDA.ID = $id
                ";
        try {
            $c = $this->banco->prepare($query);
            //$c->bindValue(1, $id);
            $ret = $c->execute();
            $this->banco = null;
            if (!$ret) {
                die('erro ao listar ');
            } else {
                $retorno = $c->fetchAll(PDO::FETCH_OBJ);
                return $retorno;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    #**************************************************
    #                  LISTAR CREDIARIO
    #                  
    #**************************************************

    function ListarCrediario($id)
    {
        $query = " SELECT V.ID AS VENDA
        ,V.DATAVENDA AS DATAVENDA
        ,V.VALOR  AS VALORTOTAL
        ,V.PARCELAS AS QTDEPARCELAS
        ,C.ID AS IDCLIENTE
        ,C.NOME  AS NOME
        ,IF(CR.PARCELASPAGAS = 0, '0',COUNT(CR.PARCELASPAGAS)) AS PARCELASPAGAS
        ,SUM(VALORPAGO) AS VALORTOTALPAGO
   FROM VENDA V INNER JOIN
        CLIENTES C ON(C.ID = V.CLIENTE) INNER JOIN
        CREDIARIO CR ON(CR.CLIENTE = C.ID AND CR.VENDA = V.ID) 
  WHERE C.ID = $id
    AND V.FOPA = 5                
    GROUP BY V.ID, V.DATAVENDA, V.VALOR, V.PARCELAS, C.ID, C.NOME
                ";
        try {
            $c = $this->banco->prepare($query);
            //$c->bindValue(1, $id);
            $ret = $c->execute();
            $this->banco = null;
            if (!$ret) {
                die('erro ao listar ');
            } else {
                $retorno = $c->fetchAll(PDO::FETCH_OBJ);
                return $retorno;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // metodo responsavel por efetuar o primeiro pagamento de um crediário
    function AlterarCrediario($parcela,$id, $valor)
    {
        $query = "UPDATE CREDIARIO SET DATAPAGAMENTO = NOW(), PARCELASPAGAS = $parcela, ESTATUS = 'Pago', VALORPAGO = $valor WHERE VENDA = $id ";
        try {
            $c = $this->banco->prepare($query);
            $ret = $c->execute();
            $this->banco = null;
            if (!$ret) {
                die('Erro ao pagar parcela!');
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
