<?php
namespace App\Controllers;
use App\Models\Notifications;
use App\Models\Estabelecimento;
use App\Models\EstabelecimentoDao;


class EstabelecimentoController extends Notifications
{
    public  function Index()
    {
        // Função para recuperar os dados do usuário que será editado.
        $id = "";
        if ($_GET && isset($_GET['id'])) {
            
            $id = $_GET['id'];
            $obterUm = new EstabelecimentoDao();            
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

        $dao = new EstabelecimentoDao();
        $ret = $dao->Listar();

        require_once "Views/Painel/Index.php";
    }

    // metodo responsavel por inserir novos registros no banco de dados

    function Inserir($dados)
    {
        $estab = new Estabelecimento();
        foreach ($dados as $chave => $valor) {
            $estab->set($chave, $valor);
        }
        $dao = new EstabelecimentoDao();
        $ret = $dao->Adicionar($estab);
        echo $this->Success("Estabelecimento", "Cadastrado", "Listar");
    }

    // Metodo responsavel por alterar os dados de um estabelecimento no baco de dados

    function Alterar($dados)
    {
        $estab = new Estabelecimento();
        foreach ($dados as $chave => $valor) {
            $estab->set($chave, $valor);
        }
        $dao = new EstabelecimentoDao();
        $ret = $dao->Alterar($estab);
        echo $this->Success("Estabelecimento", "Alterado", "Listar");
    }

    public function Listar ()
    {
        $obj = new EstabelecimentoDao();
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
        echo $this->Confirm("Excluir", "Estabelecimento", "", $id);

        require_once "Views/Shared/Header.php";
    }

    // Função responsavel por excluir um estabelecimento

    public function Delete()
    {
        $id = [];
        $id = $_GET['id'];
        $obj = new EstabelecimentoDao();
        $ret = $obj->Deletar($id);
        echo $this->Success("Estabelecimento", "Excluido", "Listar");
        require_once "Views/Shared/Header.php";
    }


}
