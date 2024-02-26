<?php

namespace App\Controllers;
use App\Models\Notifications;
use App\Models\Cliente;
use App\Models\ClienteDao;

class ClienteController extends Notifications
{
    public  function Index()
    {
        // Função para recuperar os dados do usuário que será editado.
        $id = "";
        if ($_GET && isset($_GET['id'])) {
            
            $id = $_GET['id'];
            $obterUm = new ClienteDao();            
            $return = $obterUm->ObterUm($id);
            require_once "Views/Painel/Index.php";
        }

        if ($_POST) {
            $dados = $_POST;
            if ($dados['id'] == '') {
                $this->Inserir($dados);
            } else {
                $this->Alterar($dados);
            }
        }

        $dao = new ClienteDao();
        $ret = $dao->Listar();

        require_once "Views/Painel/Index.php";
    }

    // metodo responsavel por inserir novos registros no banco de dados

    function Inserir($dados)
    {
        $objDao = new ClienteDAO();
        $max = $objDao->UltimoCodigo(); 
        $codigo = (int) $max[0]->ULTIMO;
        if(count($max) > 0 && $max != "" ){
            $newCodigo = str_pad($codigo + 1, '5','0', STR_PAD_LEFT);         
          var_dump("2 ".$newCodigo);
        }else{
            $newCodigo = '00001';
            var_dump("3 ".$newCodigo);
        }       

        $obj = new Cliente();
        foreach ($dados as $chave => $valor) {
            if($chave == 'codigo'){
                $valor = $newCodigo;
            }
            $obj->set($chave, $valor);
        }
        $dao = new ClienteDao();
        $ret = $dao->Adicionar($obj);
        echo $this->Success("Cliente", "Cadastrado", "Listar");
    }

    // Metodo responsavel por alterar os dados de um estabelecimento no baco de dados

    function Alterar($dados)
    {
        $obj = new Cliente();
        foreach ($dados as $chave => $valor) {
            $obj->set($chave, $valor);
        }
        $dao = new ClienteDao();
        $ret = $dao->Alterar($obj);
        echo $this->Success("Cliente", "Alterado", "Listar");
    }

    public function Listar ()
    {
        $obj = new ClienteDao();
        $ret = $obj->Listar();
        require_once "Views/Painel/Index.php"; 

    }
// metodo responsavel por validar a decisão do usuário ao excluir um Estabelecimento
    public function DeleteConfirm()
    {
        $id = [];
        if ($_GET) {
            $id = $_GET['id'];
        }
        echo $this->Confirm("Excluir", "Cliente", "", $id);

        require_once "Views/Shared/Header.php";
    }

    // Função responsavel por excluir um estabelecimento

    public function Delete()
    {
        $id = [];
        $id = $_GET['id'];
        $obj = new ClienteDao();
        $ret = $obj->Deletar($id);
        echo $this->Success("Cliente", "Excluido", "Listar");
        require_once "Views/Shared/Header.php";
    }
}