<?php

namespace App\Models;

use PDO;
use PDOException;

class CaixasDao extends Contexto
{

    function __construct()
    {
        parent::__construct();
    }

    function AbrirCaixa($caixa)
    {
        $this->insert("CAIXA", $caixa);
    }

    function ValidarCaixa()
    {
        $query = "SELECT * 
                    FROM CAIXA 
                    WHERE CAST(DATAABERTURA AS DATE) <= CAST(NOW() AS DATE)
                    AND ID NOT IN(SELECT CAIXA FROM CAIXAS)
                    LIMIT 1";
        try {
            $c = $this->banco->prepare($query);
            $ret = $c->execute();
            $this->banco = null;

            if (!$ret) {
                die('Erro, entre em contato com o Administrador.');
            } else {
                $retor = $c->fetchAll(PDO::FETCH_OBJ);
                return $retor;
            }
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
    }

    function FecharCaixa($caixa)
    {
        $this->insert("CAIXAS", $caixa);
    }

    function CalcularFechamento($caixa)
    {
        $query = "SELECT  C.VALORINICIAL AS VALORINICIAL,
        SUM(V.VEN_VALOR) AS VALORFINAL,
          CASE 
             WHEN V.FOPA_IDFOPA = 1  THEN  'DINHEIRO'  
             WHEN V.FOPA_IDFOPA = 3  THEN  'CREDITO'
             WHEN V.FOPA_IDFOPA = 4  THEN  'DEBITO' 
             WHEN V.FOPA_IDFOPA = 5  THEN  'CREDIARIO'       
          END AS PAGAMENTOS ,
        C.CODIGOCAIXA AS CODIGOCAIXA,
        C.USU_IDUSUARIO AS IDUSUARIO,
        (SELECT USU_NOME FROM USUARIO U WHERE U.USU_IDUSUARIO = C.USU_IDUSUARIO ) AS ABERTURA,
        CX.USU_IDUSUARIO AS IDUSUARIO,
        (SELECT USU_NOME FROM USUARIO US WHERE US.USU_IDUSUARIO = CX.USU_IDUSUARIO ) AS FECHAMENTO,
        C.DATAABERTURA AS DATAABERTURA,
        CX.DATAFECHAMENTO AS DATAFECHAMENTO
                     
   FROM CAIXAS CX INNER JOIN
         CAIXA C ON(C.CODIGOCAIXA = CX.CODIGOCAIXA) INNER JOIN
         USUARIO U ON(U.USU_IDUSUARIO = U.USU_IDUSUARIO) INNER JOIN
         VENDA V ON(V.USU_IDUSUARIO = C.USU_IDUSUARIO)                    
  WHERE C.CODIGOCAIXA = ? AND VEN_DATAVENDA BETWEEN C.DATAABERTURA AND CX.DATAFECHAMENTO
  GROUP BY C.VALORINICIAL,V.FOPA_IDFOPA,C.CODIGOCAIXA,
             C.USU_IDUSUARIO, U.USU_NOME,C.DATAABERTURA,CX.DATAFECHAMENTO";
        try {
            $c = $this->banco->prepare($query);
            $c->bindValue(1, $caixa->getId());
            $ret = $c->execute();
            $this->banco = null;

            if (!$ret) {
                die('Erro, entre em contato com o Administrador.');
            } else {
                $retorno = $c->fetchAll(PDO::FETCH_OBJ);
                return $retorno;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    function TotalCaixa()
    {
        $query = " SELECT SUM(V.VALOR) AS VALOR,        
        CASE 
          WHEN V.FOPA = 1  THEN  'DINHEIRO'  
          WHEN V.FOPA = 3  THEN  'CREDITO'
          WHEN V.FOPA = 4  THEN  'DEBITO' 
          WHEN V.FOPA = 5  THEN  'CREDIARIO'       
         END AS PAGAMENTOS,
         U.USUARIO AS NOME,
         C.DATAABERTURA,
         C.VALORINICIAL
    FROM VENDA V INNER JOIN 
         CAIXA C ON(C.USUARIO = V.USUARIO)INNER JOIN
         USUARIO U ON(U.ID = C.USUARIO)
   WHERE CAST(V.DATAVENDA AS DATE) <= CAST(NOW() AS DATE)
     AND C.USUARIO = V.USUARIO
     AND C.ID NOT IN (SELECT CAIXA FROM CAIXAS)
   GROUP BY V.FOPA, U.NOME ";
        try {
            $c = $this->banco->prepare($query);
            $ret = $c->execute();
            $this->banco = null;

            if (!$ret) {
                die('Erro, entre em contato com o Administrador.');
            } else {
                $retorno = $c->fetchAll(PDO::FETCH_OBJ);
                return $retorno;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
