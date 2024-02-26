<?php
namespace App\Models;

abstract class Notifications
{
    
    // Retorna as mensagens de sucesso na operação realizada
    protected function Success($obj, $acao, $metodo)
    {
        echo "<link rel='stylesheet' type='text/css'href='lib/css/aurora.css' />";
        $mensagem  = "<div class='mensagem'>
            <div class='span animated bounceInDown bg-p1-verde mg-t-2'>
            <h2 class='fw-300 espaco-letra txt-c fnc-branco fonte12 mg-t-2'> 
            {$obj} {$acao} com sucesso! </h2>
            <div class='botoes'>
            <a href='index.php?controller={$obj}Controller&metodo={$metodo}' class='btn fnc-branco mg-t-2 mg-auto'> Sair </a>
            </div>
            </div>
            </div>";
        return $mensagem;
    }
    // Solicita a confirmação para exclusão de dados no banco 
    protected function Confirm($mensagem, $obj, $nome, $id)
    {
        echo "<link rel='stylesheet' type='text/css'href='lib/css/aurora.css' />";
        $mensagem  = "<div class='mensagem'>
                <div class='span animated bounceInDown mg-t-2 bg-p5-watermelon'>
                <h2 class='fw-300 espaco-letra txt-c fnc-branco fonte14 mg-t-2'> 
                   
                    Deseja realmente {$mensagem} {$obj} {$nome} definitivamente? 
                </h2>
                <div class='botoes mg-t-1'>
                <a href='index.php?controller={$obj}Controller&metodo=Delete&id={$id}' class='btn fnc-cinza bg-branco mg-auto'> Sim </a>
                <a href='index.php?controller={$obj}Controller&metodo=Listar' class='btn fnc-cinza bg-branco  mg-auto'> Não </a>
                </div>
                </div>
                </div>";
        return $mensagem;
    }
    // Retorna as mensagens de erro ao efetuar o login, caso não encontre o usuário ou a senha estiver errada 
    // <i class='fa-sharp fa-solid fa-triangle-exclamation fnc-amarelo fonte30'></i>
    protected function LoginError()
    {
        echo "<link rel='stylesheet' type='text/css'href='lib/css/aurora.css' />";
        $mensagem  =  "<div class='mensagem'>
                <div class='span animated bounceInDown mg-t-2 bg-p5-watermelon'>
                <h2 class='fw-300 espaco-letra txt-c fnc-branco fonte14 mg-t-2'></i> 
                 </br> Usuário ou senha Incorreto! </h2>
                <a href='index.php' class='fnc-branco block mg-t-1 mg-auto fonte12 txt-c'> Sair </a>
            </div>
           </div>";
        return $mensagem;
    }
    // Retorna as mensagens de erro ao efetuar o login, caso não encontre o usuário ou a senha estiver errada 
    protected function alertaExclusao($controller, $metodo)
    {
        echo "<link rel='stylesheet' type='text/css'href='lib/css/aurora.css' />";
        $mensagem  =  "<div class='mensagem'>
                <div class='span animated bounceInDown mg-t-2 bg-p5-watermelon'>
                <h2 class='fw-300 espaco-letra txt-c fnc-branco fonte14 mg-t-2'> Necessário selecionar mais de 1 registro! </h2>
                <a href='index.php?controller=$controller&metodo=$metodo' class='fnc-branco block mg-t-1 mg-auto fonte12 txt-c'> Sair </a>
            </div>
           </div>";
        return $mensagem;
    }

    protected function default($mensagem, $controller, $metodo)
    {
        echo "<link rel='stylesheet' type='text/css'href='lib/css/aurora.css' />";
        $mensagem  =  "<div class='mensagem'>
                <div class='span animated bounceInDown mg-t-2 bg-p1-verde'>
                <h2 class='fw-300 espaco-letra txt-c fnc-branco fonte14 mg-t-2'> {$mensagem} </h2>
                <a href='index.php?controller={$controller}Controller&metodo=$metodo' class='fnc-branco block mg-t-1 mg-auto fonte12 txt-c'> Ok </a>
            </div>
           </div>";
        return $mensagem;
    }

    protected function Log($mensagem)
    {
        echo "<link rel='stylesheet' type='text/css'href='lib/css/aurora.css' />";
        echo "<link rel='stylesheet' type='text/css'href='lib/css/aurora.css' />";
        echo "<p class='fonte14 espaco-letra fonte-montserrat fnc-sucesso'>";
         echo $mensagem;
        echo "</p>";
        echo "<hr> <hr>";
    }
}
