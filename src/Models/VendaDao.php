<?php

namespace App\Models;

use PDO;
use PDOException;

class VendaDao extends Contexto
{
    function __construct()
    {
        parent::__construct();
    }

    function ObterUm($id)
    {
        return $this->ObterPorId("VENDA", $id);
    }

    function inserir($venda)
    {

        $this->banco->beginTransaction();
        $sql = "INSERT INTO VENDA (ID,DATAVENDA,VALOR,USUARIO,CLIENTE,FOPA ,QUANTIDADEITENS) VALUES (?,?,?,?,?,?,?)";

        try {
            $com = $this->banco->prepare($sql);
            $com->bindValue(1, $venda->getId());
            $com->bindValue(2, $venda->getDataVenda());
            $com->bindValue(3, $venda->getValor());
            $com->bindValue(4, $venda->getUsuario()->getId());
            $com->bindValue(5, $venda->getCliente()->getId());
            $com->bindValue(6, $venda->getForPag()->getId());
            $com->bindValue(7, $venda->getQtdeIt());

            $retorno = $com->execute();
            if (!$retorno) {
                die("Erro ao Inserir venda");
            } else {
                $id = $this->banco->lastInsertId();
                $sql = "INSERT INTO ITENSVENDA(ID,VENDA, PRODUTO, ITVE_QUANTIDADE, ITVE_VENDA, ITVE_PRECOUNITARIO) VALUES(?,?,?,?,?,?)";
                try {
                    $itens = $venda->getItensVenda();
                    for ($x = 0; $x < count($itens); $x++) {
                        //preparar frase para ser executada
                        $f = $this->banco->prepare($sql);

                        //substituir os pontos de interrogação
                        $f->bindValue(1, $itens[$x]->getId());
                        $f->bindValue(2, $id);
                        $f->bindValue(3, $itens[$x]->getProduto());
                        $f->bindValue(4, $itens[$x]->getQuantidade());
                        $f->bindValue(5, $itens[$x]->getItve_venda());
                        $f->bindValue(6, $itens[$x]->getPrecounitario());
                        //execução
                        $ret = $f->execute();

                        $id_prod = $itens[$x]->getProduto();
                        $updt_qtde = $itens[$x]->getQuantidade();
                        $qtde_prod = " UPDATE PRODUTO 
                                          SET QUANTIDADE = (SELECT QUANTIDADE FROM (SELECT QUANTIDADE FROM PRODUTO WHERE ID = $id_prod)X) - $updt_qtde 
                                        WHERE ID = $id_prod ";
                        $p = $this->banco->prepare($qtde_prod);
                        $updt = $p->execute();

                        if (!$ret) {
                            //desfaz todas as transações no banco de dados
                            $this->banco->rollback(); //desfaz a transação caso deu erro
                            $this->banco = null;
                            echo "Erro ao inserir itens de venda";
                        }
                    }
                    //for
                    $this->banco->commit(); //se der certo efetiva todas as transações no banco de dados  
                    $this->banco = null; //fechar a conexão
                } //try itens
                catch (Exception $e) {
                    die($e->getMessage());
                }
            }
        } //try venda
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

    //fim inserir

    function Listar()
    {
        $sql = "
        SELECT V.ID AS ID
        ,DATAVENDA
        ,VALOR
        ,USUARIO
        ,CLIENTE
        ,FOPA
        ,QUANTIDADEITENS
        ,PARCELAS
        ,C.ID AS IDCLIENTE
        ,NOME
   FROM VENDA V, CLIENTES C WHERE V.CLIENTE = C.ID ORDER BY V.ID DESC LIMIT 1
        ";
        try {
            $I = $this->banco->prepare($sql);
            $ret = $I->execute();
            $this->banco = null;
            if (!$ret) {
                echo "Erro ao selecionar vendas";
            } else {
                $retorno = $I->fetchAll(PDO::FETCH_OBJ);
                return $retorno;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function listarVendas($venda)
    {

        $sql = "
                SELECT ITV.VENDA,
                       CLI.NOME, 
                       VEN.DATAVENDA,
                       PROD.NOME,
                       PROD.PRECO,
                       PROD.DESCONTO,
                       ITV.ITVE_QUANTIDADE,
                       ITV.ITVE_PRECOUNITARIO,
                       VEN.VALOR  AS TOTAL 
                  FROM ITENSVENDA ITV INNER JOIN PRODUTO PROD ON (ITV.PRODUTO = PROD.ID) INNER JOIN 
                       VENDA VEN ON (VEN.ID = ITV.VENDA) INNER JOIN 
                       CLIENTES CLI ON(VEN.CLIENTE = CLI.ID) 
                WHERE ITV.VENDA = ?
                GROUP BY ITV.VENDA, CLI.NOME, VEN.DATAVENDA, PROD.DESCRICAO,ITV.ITVE_QUANTIDADE, ITV.ITVE_PRECOUNITARIO
                ";
        try {
            $v = $this->banco->prepare($sql);
            $v->bindValue(1, $venda->getId());
            $ret = $v->execute();
            $this->banco = null;
            if (!$ret) {
                echo "Erro ao selecionar vendas";
            } else {
                $retorno = $v->fetchAll(PDO::FETCH_OBJ);
                return $retorno;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function buscarUm($venda)
    {
        $sql = "SELECT * FROM VENDA WHERE ID = ?";
        try {
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(1, $venda->getId());
            $ret = $stmt->execute();
            $this->banco = null;
            if (!$ret) {
                die("Erro ao buscar um produto");
            } else {
                $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $resultado;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function atualizarFormaPagamento($venda)
    {
        $sql = " UPDATE VENDA 
           SET DATAVENDA = ? 
              ,VALOR = ? 
              ,CLIENTE = ? 
              ,FOPA = ? 
              ,QUANTIDADEITENS = ? 
              ,PARCELAS = ? 
        WHERE ID = ? ";
        try {
            #echo "<pre>";var_dump($venda);  echo "</pre>";
            $stmt = $this->banco->prepare($sql);

            $stmt->bindValue(1, $venda->getDataVenda());
            $stmt->bindValue(2, $venda->getValor());
            $stmt->bindValue(3, $venda->getCliente()->getId());
            $stmt->bindValue(4, $venda->getForpag()->getId());
            $stmt->bindValue(5, $venda->getQtdeIt());
            $stmt->bindValue(6, $venda->getParcela());
            $stmt->bindValue(7, $venda->getId());

            $ret = $stmt->execute();
            $this->banco = null;
            if (!$ret) {
                die("Erro ao alterar a forma de pagamento");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /*  Metodos para popular o painel de controle com indicadores e dados de graficos */

    public function totalVendas()
    {
        $query = "    
        SELECT SUM(VALOR)AS TOTALVENDAMES,
        (SELECT SUM(VALOR)
           FROM VENDA 
          WHERE YEAR(DATAVENDA) = YEAR(NOW())
            AND MONTH(DATAVENDA) = MONTH(NOW())-1)  AS TOTALVENDAMESANTERIOR,
        (SELECT SUM(VALOR) 
           FROM VENDA 
          WHERE YEAR(DATAVENDA) = YEAR(NOW())) AS TOTALVENDANOANO
   FROM VENDA 
  WHERE YEAR(DATAVENDA) = YEAR(NOW())
    AND MONTH(DATAVENDA) = MONTH(NOW())  
    ";
        try {
            $stmt = $this->banco->prepare($query);
            $ret = $stmt->execute();
            $this->banco = null;
            if (!$ret) {
                die("Ocorreu um erro, entre em contato com o administrador!");
            } else {
                $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $resultado;
            }
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function produtoMaisVendido()
    {
        $query = " SELECT LOWER(p.NOME) as PRODUTO,
                          i.PRODUTO AS IDPRODUTO,
                          SUM(i.ITVE_QUANTIDADE) AS QUANTIDADE
                     FROM ITENSVENDA i INNER JOIN 
                          PRODUTO p ON(p.ID = i.PRODUTO)
                    GROUP BY p.NOME,i.PRODUTO   
                    ORDER BY 3 DESC LIMIT 10";
        try {
            $stmt = $this->banco->prepare($query);
            $ret = $stmt->execute();
            $this->banco = null;
            if (!$ret) {
                die("Ocorreu um erro, entre em contato com o administrador!");
            } else {
                $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $resultado;
            }
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }

    public function TiposPagamentos()
    {
        $query = " SELECT fp.DESCRICAO AS FORMAPAGAMENTO,
                          SUM(v.VALOR) AS TOTAL
                     FROM FORMAPAGAMENTO fp INNER JOIN
                          VENDA v ON (v.FOPA = fp.ID)
                 GROUP BY fp.DESCRICAO";
        try {
            $stmt = $this->banco->prepare($query);
            $ret = $stmt->execute();
            $this->banco = null;
            if (!$ret) {
                die("Ocorreu um erro, entre em contato com o administrador!");
            } else {
                $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
                return $resultado;
            }
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
    }
}
