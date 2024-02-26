<?php
namespace App\Controllers;
use App\Models\Notifications;
use App\Models\Caixa;
use App\Models\CaixasDao;
use App\Models\Usuario;
use App\Models\Caixas;


class CaixasController  extends Notifications
{

    public  function Index()
    {
        require_once "Views/Pdv/Abrir.php";

        if ($_POST) {
            $dados = $_POST;
            $this->inserir($dados);
        }
    }
    // metodo responsavel por inserir novos registros no banco de dados
    function Inserir($dados)
    {        
        $obj = new Caixa();
        foreach ($dados as $chave => $valor) {
             $obj->set($chave, $valor);
        }
        $objDao = new CaixasDao();
        $ret = $objDao->AbrirCaixa($obj);
        header("Location:index.php?controller=CarrinhoController&metodo=InserirCarrinho");
    }

    function FecharCaixa()
    {
        $data = date('Y-m-d');
        $ca = new CaixasDao();
        $r = $ca->ValidarCaixa($data);
        if (count($r) > 0) {
            $cx = new CaixasDao();
            $cxr = $cx->TotalCaixa();
            require_once 'Views/Painel/index.php';
            $id = "";
            if ($_POST) {

                if (isset($_POST['inicio'])) {
                    $id = $_POST['id'];
                    $usu = $_SESSION['id'];
                    $date = date('Y-m-d H:i:s');
                    $valor = $_POST['valorfinal'];

                    $c = new Caixa($id);
                    $u = new Usuario($usu);

                    $cs = new Caixas(null, $valor, $u, $c, $date);
                    $csDAO = new CaixasDAO();
                    $csDAO->FecharCaixa($cs);

                    $id = $_POST['id'];

                    echo "<div class='aviso-padrao'>";
                    echo "<div class='caixa bg-branco pd-20'>";
                    echo "<div class='span' animated bounceInLeft'>";
                    echo "<h2 class='fonte-open-sans espaco-letra txt-c fnc-preto fonte12'> <i class='fas fa-check fonte20 fnc-sucesso'></i> Caixa Fechado com sucesso!</h2>";
                    echo "<a href='index.php?controle=CaixasControle&metodo=Fechamento&id=$id' class='btn-100 fnc-preto bg-cinza mg-b-10 mg-t-20 mg-auto'>OK </a>";
                    echo "</div>";
                    echo "</div>";
                }
            }
        } else {
            require_once 'Views/Shared/Header.php';

            echo "<div class='aviso-padrao'>";
            echo "<div class='caixa bg-branco pd-20'>";
            echo "<div class='span' animated bounceInLeft'>";
            echo "<h2 class='fonte-open-sans espaco-letra txt-c fnc-preto fonte12'> <i class='far fa-frown fonte20 fnc-erro'></i> OPS <br> Não há Caixa aberto no momento.<br>Por favor, abra o Caixa!</h2>";
            echo "<a href='index.php?cotroller=CaixasController&metodo=AbrirCaixa' class='btn-100 fnc-preto bg-cinza mg-b-10 mg-t-20 mg-auto'>OK </a>";
            echo "</div>";
            echo "</div>";
        }
    }

    function Fechamento()
    {
        $cx = new CaixasDAO();
        $cxr = $cx->TotalCaixa();
        $id = "";
        if ($_GET) {
            $id = $_GET['id'];
            $c = new Caixa($id);
            $csDAO = new CaixasDAO();
            $ret = $csDAO->CalcularFechamento($c);
            require_once 'source/Views/controle-fechamento.php';
        }
    }
}
