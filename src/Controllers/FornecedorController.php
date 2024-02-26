<?php

namespace App\Controllers;
use App\Models\Fornecedor;
use App\Models\FornecedorDao;
use App\Models\Notifications;

class FornecedorController extends Notifications
{
    public  function Index()
    {
        // Função para recuperar os dados do usuário que será editado.
        $id = "";
        if ($_GET && isset($_GET['id'])) {
            
            $id = $_GET['id'];
            $obterUm = new FornecedorDao();            
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

        $dao = new FornecedorDao();
        $ret = $dao->Listar();

        require_once "Views/Painel/Index.php";
    }

    // metodo responsavel por inserir novos registros no banco de dados

    function Inserir($dados)
    {
        $categ = new Fornecedor();
        foreach ($dados as $chave => $valor) {
            $categ->set($chave, $valor);
        }
        $obj = new FornecedorDao();
        $ret = $obj->Adicionar($categ);
        echo $this->Success("Fornecedor", "Cadastrado", "Listar");
    }

    // Metodo responsavel por alterar os dados de um estabelecimento no baco de dados

    function Alterar($dados)
    {
        $categ = new Fornecedor();
        foreach ($dados as $chave => $valor) {
            $categ->set($chave, $valor);
        }
        $obj = new FornecedorDao();
        $ret = $obj->Alterar($categ);
        echo $this->Success("Fornecedor", "Alterado", "Listar");
    }

    public function Listar ()
    {
        $obj = new FornecedorDao();
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
        echo $this->Confirm("Excluir", "Fornecedor", "", $id);

        require_once "Views/Shared/Header.php";
    }

    // Função responsavel por excluir um estabelecimento

    public function Delete()
    {
        $id = [];
        $id = $_GET['id'];
        $obj = new FornecedorDao();
        $ret = $obj->Deletar($id);
        echo $this->Success("Fornecedor", "Excluido", "Listar");
        require_once "Views/Shared/Header.php";
    }
}