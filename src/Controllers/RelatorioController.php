<?php

namespace App\Controllers;

use App\Models\EstabelecimentoDao;
use App\Models\Venda;
use App\Models\VendaDao;
use Dompdf\Dompdf;

class RelatorioController
{
    function gerarPdf()
    {
        $id = "";

        $html = "<!DOCTYPE html>";
        $html .= "<html lang='pt-br'>";
        $html .= "<head>";
        $html .= "<meta charset='UTF-8'>";
        $html .= "<link rel='stylesheet' href='../lib/css/aurora.css' /> ";
        $html .= "</head>";
        $html .= "<body>";

        $data = date("d-m-y");
        $hora = date("H:i:s");

        $emp = new EstabelecimentoDao();
        $getEmp = $emp->Listar();

        $html .= "<h1 class='fonte-open espaco-letra fonte7 bg-gradiente-azul-roxo'> Recibo de venda </h1>";

        if ($_GET) {

            $id = $_GET['id'];

            $venda = new Venda($id);
            $obj = new VendaDao();
            $getVenda = $obj->listarVendas($venda);

            if (count($getVenda) > 0) {
                foreach ($getVenda as $dados) {
                }
            }
        }
        
        $html .= "</body>";

        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);

        $dompdf->setPaper([0, 0, 303, 2000]);

        $dompdf->render();
        $dompdf->stream("comprovante.pdf", ["Attachment" => false]);
    }
}
