<?php 

namespace App\Configurations;

class Formater
{
    public function converterMoeda($var){
        return number_format($var,2,',','.');
    }    
    public function converterMoedaBd($var){
        $var = str_replace(".","",$var);
        $var = str_replace(",",".",$var);
        return $var;
    }    
    function formataTextoLow($var){
        return strtolower($var);
    }    
    function formataTextoCap($var){
        return ucwords(strtolower($var));
    }    
    function formataTextoUpp($var){
        return strtoupper(strtolower($var));
    }    
    public function formatarDataTime($data){
        date_default_timezone_set('America/Sao_Paulo');
        return date('d-m-Y H:i:s',$data);
    }    
    public function formatarData($data){
        date_default_timezone_set('America/Sao_Paulo');
        return date('d/m/Y', strtotime($data));
    }

    public function retornaHora(){
        date_default_timezone_set('America/Sao_Paulo');
        return date('H:i');
    }

    public function retornaData(){
        date_default_timezone_set('America/Sao_Paulo');
        return date('d/m/Y');
    }

    public function retornaDataHora(){
        date_default_timezone_set('America/Sao_Paulo');
        return date('d-m-Y H:i:s');
    }

    public function QuebraDeLinha($string){
        return $string = str_replace('.', '.<br>', $string);      
    }
    public function zeroEsquerda($num, $qtde,$char){
        return $num = str_pad($num, $qtde, $char, STR_PAD_LEFT);     
    }

}