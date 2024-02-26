<?php

namespace App\Controllers;

ob_start();
if (!isset($_SESSION)) {
    session_start();
}

use App\Models\Notifications;
use App\Models\CaixasDao;
use App\Models\ClienteDao;
use App\Models\FormaPagamentoDao;
use App\Models\Usuario;
use App\Models\FormaPagamento;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\VendaDao;
use App\Models\Produto;
use App\Models\ProdutoDao;



class CarrinhoController extends Notifications
{

    function InserirCarrinho()
    {      

        $ca = new CaixasDao();
        $r = $ca->ValidarCaixa();

        if (count($r) > 0) {

            $objC = new ClienteDao();
            $getC = $objC->Listar(); # selecinarFormaPagamento

            $objFp = new FormaPagamentoDao();
            $getFp = $objFp->selecinarFormaPagamento();

            require_once "Views/Pdv/Index.php";
            if ($_POST) {
                $existe = false;
                $linha = -1; //para começar no indice 0 da matriz  0+(-1)=0

                $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_STRING);  
                //vindo do link da imagem carrinho sempre que um dado é passado via link ele vem no método GET
                //procurar na sessão carrinho de o produto ja foi inserido
                if (isset($_SESSION["carrinho"])) { //isset verifica se a sessão existe ou não
                    // var_dump("Dentro da section carinho",$_POST);
                    foreach ($_SESSION["carrinho"] as $linha => $valor) { //linha tem as linhas e valor tem o conteudo dentro da linha 
                        if ($valor["codS"] == $codigo) {
                            $existe = true;
                        }
                    } //foreach
                } //isset				    

                if (!$existe) {
                    // var_dump("Se não existir",$_POST);
                    //caso não exista insere o produto no carrinho
                    $prodDAO = new ProdutoDAO();
                    $ret = $prodDAO->ObterComCodigo($codigo);

                    if (count($ret) > 0) {

                        $_SESSION["carrinho"][$linha + 1]["id"] = $ret[0]->ID;
                        $_SESSION["carrinho"][$linha + 1]["nomeS"] = $ret[0]->NOME;
                        $_SESSION["carrinho"][$linha + 1]["codS"] = $codigo;
                        $_SESSION["carrinho"][$linha + 1]["precoS"] = $ret[0]->PRECO;
                        $_SESSION["carrinho"][$linha + 1]["descS"] = $ret[0]->DESCONTO;
                        $_SESSION["carrinho"][$linha + 1]["estoqueS"] = $ret[0]->QUANTIDADE;
                        $_SESSION["carrinho"][$linha + 1]["qtdeS"] = 1;
                    }
                }
            }
        } else {
            require_once "Views/Shared/Header.php";
                    echo "<div class='aviso-padrao'>";
                    echo "<div class='caixa bg-branco pd-20'>";
                    echo "<div class='animated bounceInLeft'>";
                    echo "<h2 class='fonte-open-sans espaco-letra txt-c fnc-preto fonte12'>Você precisa abrir um caixa. <i class='fa-solid fa-cash-register fonte28 mg-l-1'></i> </h2>";
                    echo "<a href='index.php?controller=CaixasController&metodo=Index' class='btn-100 fonte14 fnc-branco bg-p2-azul mg-b-1 mg-t-2 mg-auto'>Abrir caixa agora.</a>";
                    echo "<a href='index.php?controller=PainelController&metodo=Index' class='btn-100 fonte14 fnc-preto-1 mg-b-1 mg-t-1 mg-auto'>Abrir caixa depois</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
        }
        // require_once "views/carrinhoCompras.php";
    }

    //====================================================================================================
    //FIM  DO METODO INSERIR CARRINHO//
    //====================================================================================================
    function AtualizarCarrinho()
    {

        if ($_GET) {
            $linha = $_GET["linha"];
            unset($_SESSION["carrinho"][$linha]); //unset exclui apenas uma linha
            header("Location:index.php?controller=CarrinhoController&metodo=InserirCarrinho");
        }
        //Alterar a quantidade n sessão
        if ($_POST) {
            $lin = $_POST["linha"];
            $qtde = $_POST["quantidade"];
            if ($qtde >= 0) {
                $_SESSION["carrinho"][$lin]["qtdeS"] = $qtde;
            }
        }
    }

    //====================================================================================================
    //FIM DO METODO ATUALIZAR CARRINHO//
    //====================================================================================================
    function finalizarCarrinho()
    {    
         $total = 0;
         $qtdeItem = 0;
         if (!isset($_SESSION["id"])) { //se não estiver logado envia para pagina de login
             header("location:index.php?controller=BaseController&metodo=Login");
         } else {

        //     //se estiver logado então             
        //     //o id do usuario so irá aparecer quando ele estiver logao por isso  $_session["id"]
             $usuario = new Usuario($_SESSION["id"]);
             $fopa = new FormaPagamento(1);
             $cliente = new Cliente(1); //o id do usuario so irá aparecer quando ele estiver logao por isso  $_session["id"]
             $data = date("Y-m-d H:i:s"); //pega a data atual ou seja a data do dia da compra              


             foreach ($_SESSION["carrinho"] as $lin => $item) {
                 $subtotal = $item["precoS"] * $item["qtdeS"];
        //         //calcula o desconto
                 $desc = $subtotal * $item['descS'] / 100;
        //         //tira do subtotal o desconto
                 $subtotal = $subtotal - $desc;
        //         //acumula o total
                 $total = $total + $subtotal;
                 $qtdeItem = $qtdeItem + $item['qtdeS'];
             }
             # echo $total;
             #echo '<pre>';var_dump($_SESSION['carrinho']);echo '</pre>';

             $venda = new Venda(NULL, $data, $total, $usuario, $cliente, $fopa, $qtdeItem, null); 
        //     // metodo que verifica se a quantidade solicitada de um produto existe no estoque
             foreach ($_SESSION["carrinho"] as $lin => $item) { 
                 if ($item["qtdeS"] > $item["estoqueS"] || $item["estoqueS"] = 0) {
                     require_once 'Views/Shared/Header.php';
                     echo "<div class='aviso-padrao'>";
                     echo "<div class='caixa bg-branco pd-20'>";
                     echo "<div class='animated bounceInLeft'>";
                     echo "<h2 class='fonte-open-sans espaco-letra txt-c fnc-cinza fonte14'><i class='far fa-frown fonte26 fnc-error'></i> Desculpe, a quantidade solicitada do produto <span class='fnc-error'>{$item['nomeS'] } </span> é menor do que temos disponivel. <br> temos apenas " . $item["estoqueS"]." unidades em nosso estoque. </h2>";
                     echo "<a href='index.php?controller=CarrinhoController&metodo=InserirCarrinho' class='btn-100 fonte14 fnc-cinza bg-p5-carbon mg-b-1 mg-t-2 mg-auto'>Retornar ao Carrinho</a>";
                     echo "</div>";
                     echo "</div>";
                     echo "</div>";
                     die();
                 } else {
                     $produto = new Produto($item["id"]);
                     $atributos = $produto->atributos(true);
                     foreach (array_slice($atributos, 1) as $atributo) {
                         $produto->get($atributo);
                     }
                     $venda->setItensVenda(NULL, $venda, $produto->get('id'), $item["qtdeS"], null, $item["precoS"]); //passar os parametros na ordem que esta na classe
                 }
             }
             $vendaDAO = new VendaDao();
            
             $vendaDAO->inserir($venda);
             unset($_SESSION["carrinho"]);
             #session_destroy();
             $venDAO = new VendaDao();
             $rets = $venDAO->Listar();
        //     // echo '<pre>'; var_dump($rets); echo '</pre>';
            header("Location:index.php?controller=BaseController&metodo=AlterarFormaPagamento&id={$rets[0]->ID}");
            //header("location:index.php?controle=relatorioControle&metodo=imprimirVenda");
        }
    }
}
