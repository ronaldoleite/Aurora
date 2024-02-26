<?php
namespace App\Controllers;
use App\Models\Notifications;
use App\Models\VendaDao;

class PainelController extends Notifications
{

    public function Index()
    {
        $objDao = new VendaDao();
        $getVenda = $objDao->totalVendas();
        require_once "Views/Painel/Index.php";
    }

     public function GraficoMaisVendido()
     {
         $objDao1 = new VendaDao();
         echo json_encode($getProd = $objDao1->produtoMaisVendido());
     }

     public function GraficoTipoPag()
     {
         $objDao1 = new VendaDao();
         echo json_encode($getProd = $objDao1->TiposPagamentos());
     }

}
?>