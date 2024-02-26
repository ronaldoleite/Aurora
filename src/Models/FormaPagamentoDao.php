<?php

namespace App\Models;
use PDO;
use PDOException;

class FormaPagamentoDAO extends Contexto{

    function __construct() {
        parent:: __construct();
    }
    
      function selecinarFormaPagamento(){
          $query = "SELECT * FROM FORMAPAGAMENTO";
          try{
              $stm = $this->banco->prepare($query);
              $ret = $stm->execute();
              $this->banco = null;
              
              if(!$ret){
                  die("Erro ao buscar Forma de pagamento!");
              }else{
                  $retorno = $stm->fetchAll(PDO::FETCH_OBJ);
                  return $retorno;
              }
          }catch(PDOException $e){
              die($e->getMessage());
          }
      }
}
