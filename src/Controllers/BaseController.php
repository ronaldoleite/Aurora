<?php

namespace App\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Usuario;
use App\Models\VendaDao;
use App\Models\Crediario;
use App\Models\ClienteDao;
use App\Models\UsuarioDao;
use App\Models\CrediarioDao;
use App\Models\Notifications;
use App\Models\FormaPagamento;
use App\Models\FormaPagamentoDao;

class BaseController extends Notifications
{
    // Função responsavel por validar o acesso dos usuários ao sistema.

    public function Login()
    {
        require_once "Views/Home/Home.php";
        if ($_POST) {
            $s = "";
            $usu = $_POST["usuario"];
            $password = $_POST["senha"];
            $usuarioDAO = new UsuarioDao();
            $ret = $usuarioDAO->autenticar($usu);
            if (count($ret) > 0) $s = $ret[0]->SENHA;
            if (password_verify($password, $s) && count($ret) > 0) {
                $_SESSION["permissao"] = -1;
                $_SESSION["id"] = $ret[0]->ID;
                $_SESSION["nome"] = $ret[0]->NOME;
                $_SESSION["imagem"] = $ret[0]->IMAGEM;
                header("Location:index.php?controller=CarrinhoController&metodo=InserirCarrinho");
            } else {
                echo $this->LoginError();
            }
        }
    }
  
    function validarExclusaoProdCarrinho()
    {       
        if ($_GET) {

            $lin = $_GET['linha'];
            echo "<div class='aviso-padrao'>";
            echo "<div class='caixa bg-p7-vermelho shadow-down pd-20'>";
            echo "<div class='span animated bounceInLeft'>";
            echo "<h2 class='fonte-poppin espaco-letra txt-c fnc-cinza fonte12'><i class='fas fa-times fonte26 fnc-error mg-t-1'></i>&nbsp;&nbsp; Deseja realmente excluir este produto do carrinho?</h2>";
            echo "<div class='flex justify-center'>";
            echo "<a href='index.php?controller=CarrinhoController&metodo=AtualizarCarrinho&linha=$lin' class='small-btn fonte12 fnc-branco bg-p1-laranja mg-b-1 mg-t-2 mg-auto'> Sim</a>";
            echo "<a href='index.php?controller=CarrinhoController&metodo=InserirCarrinho' class='small-btn fonte12 fnc-branco bg-p4-powder mg-b-1 mg-t-2 mg-auto' selected> Não</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            require_once 'Views/Pdv/Index.php';
        }
    }

    // Alterar a forma de pagamento

    function AlterarFormaPagamento()
    {
        $id = "";
        if ($_GET) {
            $id = $_GET['id'];

            $cliDAO = new ClienteDao();
            $cli = $cliDAO->Listar();

            $fpDAO = new FormaPagamentoDao();
            $fp = $fpDAO->selecinarFormaPagamento();

            $venda = new Venda($id);
            $vendaDAO = new VendaDao();
            $retorno = $vendaDAO->buscarUm($venda);

            // echo "<pre>";var_dump($retorno);echo "</pre>";

            $venda->setId($retorno[0]->ID);
            $venda->setDataVenda($retorno[0]->DATAVENDA);
            $venda->setValor($retorno[0]->VALOR);
            $usuario = new Usuario($retorno[0]->USUARIO);
            $venda->setUsuario($usuario);
            $cliente = new Cliente($retorno[0]->CLIENTE);
            $venda->setCliente($cliente);
            $fopa = new FormaPagamento($retorno[0]->FOPA);
            $venda->setForPag($fopa);
            $venda->setQtdeIt($retorno[0]->QUANTIDADEITENS);
            //echo "<pre>";var_dump($retorno);echo "</pre>";
            require_once "Views/Pdv/Pagamento.php";
        }
        if ($_POST) {
            if (isset($_POST["Cadastrar"])) {
                $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
                $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
                $qtde = filter_input(INPUT_POST, 'qtde', FILTER_SANITIZE_STRING);
                $usu = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
                $clien = filter_input(INPUT_POST, 'cliente', FILTER_SANITIZE_STRING);
                $formpag = filter_input(INPUT_POST, 'formapag', FILTER_SANITIZE_STRING);
                $parcelas = filter_input(INPUT_POST, 'parcela', FILTER_SANITIZE_STRING);
                $valor = filter_input(INPUT_POST, 'valor', FILTER_SANITIZE_STRING);

                $usua = new Usuario($usu);
                $clie = new Cliente($clien);
                $fpgt = new FormaPagamento($formpag);

                // se a forma de pagamento for = 5 INSERE NA TABELA CREDIARIO
                if ($formpag == 5) {                
                    
                    $venda = new Venda($id, $data, $valor, $usua, $clie, $fpgt, $qtde, $parcelas);
                    $vDAO = new VendaDAO();
                    $vDAO->atualizarFormaPagamento($venda);

                    $crediario = new Crediario(null, null, 'Pendente', $clien, $id, 0);
                    $vd = new CrediarioDao();
                    $vd->Adicionar($crediario);
                } else {
                    # Caso o tipo de pagamento for diferente de 5 (Crediario), atualiza a tabela de vendas 
                    $venda = new Venda($id, $data, $valor, $usua, $clie, $fpgt, $qtde, $parcelas);
                    $vDAO = new VendaDAO();
                    $vDAO->atualizarFormaPagamento($venda);
                }
                echo "<div class='aviso-padrao'>";
                echo "<div class='caixa  shadow-down pd-20'>";
                echo "<div class='span' animated bounceInLeft flex item-centro'>";
                echo "<h2 class='fonte-poppin espaco-letra txt-c fnc-preto fonte12'><i class='fas fa-print fonte26 fnc-cinza'></i>&nbsp;&nbsp; Deseja Imprimir esta venda?</h2>";
                echo "<div class='flex justify-between'>";
                echo "<a href='index.php?controller=RelatorioController&metodo=gerarPdf&id={$id}' class='small-btn fnc-branco bg-p5-watermelon mg-b-1 mg-t-2 mg-auto' target='blank'>Sim</a>";
                echo "<a href='index.php?controller=CarrinhoController&metodo=InserirCarrinho' class='small-btn fnc-branco bg-p2-azul mg-auto mg-b-1' > Não </a>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
        }
    }
}