<?php

namespace App\Controllers;
use App\Models\Notifications;
use App\Models\CategoriaDao;
use App\Models\Categoria;

class CategoriaController extends Notifications
{
    public  function Index()
    {
        // Função para recuperar os dados do usuário que será editado.
        $id = "";
        if ($_GET && isset($_GET['id'])) {
            
            $id = $_GET['id'];
            $obterUm = new CategoriaDao();            
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

        $dao = new CategoriaDao();
        $ret = $dao->Listar();

        require_once "Views/Painel/Index.php";
    }

    // metodo responsavel por inserir novos registros no banco de dados

    function Inserir($dados)
    {
        $categ = new Categoria();
        foreach ($dados as $chave => $valor) {
            $categ->set($chave, $valor);
        }
        $obj = new CategoriaDao();
        $ret = $obj->Adicionar($categ);
        echo $this->Success("Categoria", "Cadastrado", "Listar");
    }

    // Metodo responsavel por alterar os dados de um estabelecimento no baco de dados

    function Alterar($dados)
    {
        $categ = new Categoria();
        foreach ($dados as $chave => $valor) {
            $categ->set($chave, $valor);
        }
        $obj = new CategoriaDao();
        $ret = $obj->Alterar($categ);
        echo $this->Success("Categoria", "Alterado", "Listar");
    }

    public function Listar ()
    {
        $obj = new CategoriaDao();
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
        echo $this->Confirm("Excluir", "Categoria", "", $id);

        require_once "Views/Shared/Header.php";
    }

    // Função responsavel por excluir um estabelecimento

    public function Delete()
    {
        $id = [];
        $id = $_GET['id'];
        $obj = new CategoriaDao();
        $ret = $obj->Deletar($id);
        echo $this->Success("Categoria", "Excluido", "Listar");
        require_once "Views/Shared/Header.php";
    }
}