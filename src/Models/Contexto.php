<?php

namespace App\Models;

use PDO;
use PDOException;

class Contexto
{
    protected $banco;

    protected function __construct() {
        $inf = "mysql:host=localhost;dbname=ar3_pdv";
        try {
            $this->banco = new PDO($inf, "root", "",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->banco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // função responsavel por listar os objetos no banco de dados

    protected function ObterTodos($tabela){
        $sql = "SELECT * FROM {$tabela} ORDER BY ID DESC";
        try{
            $p = $this->banco->prepare($sql);
            $ret = $p->execute();
            $this->banco = null; 

            if(!$ret){
                echo "Erro ao buscar {$tabela}";
            }else{
                $retor = $p->fetchAll(PDO::FETCH_OBJ);
                return $retor;
            }

        }catch(PDOException $e){
           die($e->getMessage());
        }
    }

    protected function ObterPorId($tabela,$id){
        $sql = "SELECT * FROM {$tabela} WHERE ID = ?";
        try{
            $p = $this->banco->prepare($sql);
            $p->bindValue(1, $id);
            $ret = $p->execute();
            $this->banco = null; 

            if(!$ret){
                echo "Erro ao buscar {$tabela}";
            }else{
                $retor = $p->fetchAll(PDO::FETCH_OBJ);
                return $retor;
            }

        }catch(PDOException $e){
           die($e->getMessage());
        }
    }

    protected function ObterPorCodigo($tabela,$codigo){
        $sql = "SELECT * FROM {$tabela} WHERE CODIGO = ?";
        try{
            $p = $this->banco->prepare($sql);
            $p->bindParam(1, $codigo);
            $ret = $p->execute();
            $this->banco = null; 

            if(!$ret){
                echo "Erro ao buscar {$tabela}";
            }else{
                $retor = $p->fetchAll(PDO::FETCH_OBJ);
                return $retor;
            }

        }catch(PDOException $e){
           die($e->getMessage());
        }
    }

    // função responsavel por cadastrar os objetos no banco de dados

    protected function insert($tabela, $objeto){
        $atributos = $objeto->atributos();
        $sql = "INSERT INTO {$tabela}(".implode(',', array_slice($atributos, 1)).") 
                        VALUES(".implode(',', array_fill(0, (count($atributos)-1), '?')).")";

        try {
            $stmt = $this->banco->prepare($sql)
            ;
            foreach (array_slice($atributos, 1) as $x => $atributo) {
                $stmt->bindValue(($x+1), $objeto->get($atributo));
            }
            $ret = $stmt->execute();
            $id = $this->banco->lastInsertId();
            $this->banco = null;

            if(!$ret){
                echo "Erro ao inserir dados";
            }else{
                return $id;
            }


        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // função responsavel por Atualizar os objetos no banco de dados

    protected function update($tabela, $objeto){
        $atributos = $objeto->atributos(true);
        $sql = "UPDATE {$tabela} SET ".implode(',', preg_filter('/$/', '=?', array_slice($atributos,1)))." 
                        WHERE id = ?";

        try {
            $stmt = $this->banco->prepare($sql);
            $i = 1;
            foreach (array_slice($atributos, 1) as $atributo) {
                $stmt->bindValue($i, $objeto->get($atributo));
                $i++;
            }
            $stmt->bindValue($i, $objeto->get('id'));
            $ret = $stmt->execute();
            $this->banco = null;

            if(!$ret){
                echo "Erro ao alterar dados";
            }else{
                return true;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

// função responsavel por excluir dados no banco de dados

    protected function delete($tabela, $id){
        $sql = "DELETE FROM {$tabela}  WHERE id = ? LIMIT 1";

        try {
            $stmt = $this->banco->prepare($sql);
            $stmt->bindValue(1, $id);
            $ret = $stmt->execute();
            $this->banco = null;

            if(!$ret){
                echo "Erro ao apagar dados";
            }else{
                return true;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    protected function UltimoRegistro($tabela, $campo){
        
        $sql ="SELECT MAX({$campo}) AS ULTIMO FROM {$tabela}";

        try{
            $p = $this->banco->prepare($sql);
            $ret = $p->execute();
            $this->banco = null; 

            if(!$ret){
                echo "Erro ao buscar {$tabela}";
            }else{
                $retor = $p->fetchAll(PDO::FETCH_OBJ);
                return $retor;
            }

        }catch(PDOException $e){
           die($e->getMessage());
        }

    }
}
