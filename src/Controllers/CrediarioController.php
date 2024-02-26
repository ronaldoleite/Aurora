<?php
namespace App\Controllers;
use App\Models\Notifications;
use App\Models\Crediario;
use App\Models\CrediarioDao;

class CrediarioController extends Notifications
{
    // public  function Index()
    // {
    //     $cli = new ClienteDao();
    //     $getCli = $cli->Listar();

    //     $ven = new VendaDao();
    //     $getVenda = $ven->Listar();
    //     // Função para recuperar os dados do crediário que será editado.
    //     $id = "";
    //     if ($_GET && isset($_GET['id'])) {

    //         $id = $_GET['id'];
    //         $obterUm = new CrediarioDao();
    //         $return = $obterUm->ObterUm($id);
    //         require_once "Views/Painel/Index.php";
    //     }

    //     if ($_POST) {
    //         $dados = $_POST;
    //         if ($dados['id'] == '') {
    //             $this->Inserir($dados);
    //         } else {
    //             $this->Alterar($dados);
    //         }
    //     }

    //     $dao = new CategoriaDao();
    //     $ret = $dao->Listar();

    //     require_once "Views/Painel/Index.php";
    // }

    // // metodo responsavel por inserir novos registros no banco de dados

    // function Inserir($dados)
    // {
    //     $obj = new Crediario();
    //     foreach ($dados as $chave => $valor) {
    //         $obj->set($chave, $valor);
    //     }
    //     $objDao = new CrediarioDao();
    //     $ret = $objDao->Adicionar($obj);
    //     echo $this->Success("Crediario", "Cadastrado", "Listar");
    // }



    // function Alterar($dados)
    // {
    //     $obj = new Crediario();
    //     foreach ($dados as $chave => $valor) {
    //         $obj->set($chave, $valor);
    //     }
    //     $objDao = new CrediarioDao();
    //     $ret = $objDao->Alterar($obj);
    //     echo $this->Success("Crediario", "Alterado", "Listar");
    // }

    // // public function Listar ()
    // // {
    // //     $obj = new CrediarioDao();
    // //     $ret = $obj->Listar();
    // //     require_once "Views/Painel/Index.php"; 

    // // }

    function Listar()
    {

        $id = "";
        if ($_GET) {
            $id = $_GET['id'];
            $src = new CrediarioDao();
            $cre = $src->ListarCrediario($id);
            require_once 'Views/Painel/Index.php';
        }
    }

    // function Crediario()
    // {
    //     $id = "";
    //     if ($_GET) {
    //         $id = $_GET['id'];
    //         $cc = new CrediarioDao();
    //         $cred = $cc->ListarUmCrediario($id);
    //         require_once 'Views/Painel/Index.php';
    //     }
    //  }
    // Metodo para efetuar o pagamento de um crediário
    function PagarCrediario()
    {
         $id = "";
        $qtde = "";       
        
    
        if ($_POST) {
            $dados = $_POST;
            $id = $dados['venda'];
            $qtde = $dados['parcelaspagas'];
            $data = date('Y-m-d H:i:s');
            $valorpg = $dados['valorpago'];

            //echo $this->Log("Este é o valor recebido via post de qtde de parcelas pagas {$qtde} ");
            
            if ($qtde == 0) {  
                $objDao = new CrediarioDao();                  
                $objDao->AlterarCrediario('1', $id, $valorpg);  
               // echo $this->Log("Este é o valor de qtde ao pagar primeira parcelas {$qtde} ");             
            } else {

               $crediario = new Crediario();
               $qtde = $qtde + 1;
               $estatus = "Pago";
               //echo $this->Log("Este é o valor de qtde somado caso não seja a segunda parcela {$qtde} ");  
                foreach ($dados as $chave => $valor) {
                    if ($chave == "estatus") $valor = $estatus;
                    if ($chave == "datapagamento") $valor = $data;
                    if ($chave == "parcelaspagas") $valor = $qtde ;
                    $crediario->set($chave, $valor);
                }
                //echo $this->Log("Este é o valor de qtde enviado para o metodo de adicionar {$qtde} "); 
                $obj = new CrediarioDao();
                $obj->Adicionar($crediario);
            }
            echo $this->default("Pagamento efetuado!", "Cliente", "Listar");
        }
    }

    // // metodo responsavel por validar a decisão do usuário ao excluir um Estabelecimento
    // public function DeleteConfirm()
    // {
    //     $id = [];
    //     if ($_GET) {
    //         $id = $_GET['id'];
    //     }
    //     echo $this->Confirm("Excluir", "Crediario", "", $id);

    //     require_once "Views/Shared/Header.php";
    // }

    // // Função responsavel por excluir um estabelecimento

    // public function Delete()
    // {
    //     $id = [];
    //     $id = $_GET['id'];
    //     $obj = new CrediarioDao();
    //     $ret = $obj->Deletar($id);
    //     echo $this->Success("Crediario", "Excluido", "Listar");
    //     require_once "Views/Shared/Header.php";
    // }
}
