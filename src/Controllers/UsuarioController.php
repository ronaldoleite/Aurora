<?php

namespace App\Controllers;
use App\Models\Usuario;
use App\Models\PerfilDao;
use App\Models\UsuarioDao;
use App\Models\Notifications;


class UsuarioController extends Notifications
{
    
    // Função responsavel por buscar todos os usuários cadastrados no banco de dados

    public function Listar()
    {
        $usuDao = new UsuarioDao();
        $ret = $usuDao->ListarTodos();
        // Caso haja solicitação de exclusão e massa
        if ($_POST) {
            if ($_POST["DeletarTodos"] && isset($_POST['id_del']) && count($_POST['id_del']) > 1) {
                $post = filter_input_array(INPUT_POST, FILTER_DEFAULT);
                foreach ($post['id_del'] as $id => $usuario) {
                    $usuDao = new UsuarioDao();
                    $usuDao->deletar($id, $usuario);
                }
                echo $this->Success("Usuario", "Excluidos", "Listar");
            } else {
                echo $this->alertaExclusao("UsuarioController", "Listar");
            }
        }
        require_once "Views/Painel/Index.php";
    }

    // Função responsavel por validar os dados recebidos e definir se ira inserir ou alterar um usuário

    function Index()
    {
        $perfilDAO = new PerfilDao();
        $perf = $perfilDAO->listar();
        // Função para recuperar os dados do usuário que será editado.
        $id = "";
        if ($_GET && isset($_GET['id'])) {
            $id = $_GET['id'];
            $obterUm = new UsuarioDao();
            $return = $obterUm->ObterUm($id);
            require_once "Views/Painel/Index.php";
        }

        if ($_POST) {

            $dados = $_POST;
            $files = $_FILES;
            if ($dados['id'] == '') {
                $this->Inserir($dados, $files);
            } else {
                $this->Alterar($dados, $files);
            }
        }

        $usuDao = new UsuarioDao();
        $ret = $usuDao->ListarTodos();

        if (is_string($ret)) {
            echo "<div class='alert alert-danger'>{$ret}</div>";
        }
        require_once "Views/Painel/Index.php";
    }

    // Função responsavel por inserir um usuário

    function inserir($dados, $files)
    {
        $figura = "";
        $diretorio = "lib/img/users-images";

        if ($files["imagem"]["name"] != "") {
            $figura = $files["imagem"]["name"];
            $caminho_imagem = $diretorio;
            if (file_exists($caminho_imagem)) {
                $novoNome = uniqid() . $figura;
                $figura = $novoNome;
            }
            move_uploaded_file($files["imagem"]["tmp_name"], $caminho_imagem . "/" . $figura);
            $usuario = new Usuario();
            $dados['imagem'] = $figura;
            foreach ($dados as $chave => $valor) {
                if ($chave == 'senha') {
                    $valor =  password_hash($valor, PASSWORD_BCRYPT);
                }
                $usuario->set($chave, $valor);
            }
            $usuDao = new UsuarioDao();
            $ret = $usuDao->Adicionar($usuario);
           echo $this->Success("Usuario", "Cadastrado", "Listar");
        }
    }

    // função responsavel por validar a opção do usuário em excluir um usuário

    public function DeleteConfirm()
    {
        $id = [];
        if ($_GET) {
            $id = $_GET['id'];
        }
        echo $this->Confirm("Excluir", "Usuario", "", $id);

        require_once "Views/Shared/Header.php";
    }

    // Função responsavel por excluir um usuário

    public function Delete()
    {
        $id = [];
        $id = $_GET['id'];
        $usuDao = new UsuarioDao();
        $ret = $usuDao->deletar($id);
        echo $this->Success("Usuario", "Excluido", "Listar");
        require_once "Views/Shared/Header.php";
    }

    // Função responsavel por alterar os dados de um usuário

    function alterar($dados, $files)
    {
        $figura = "";
        $diretorio = "lib/img/users-images";
        if ($files["imagem"]["name"] != "") {
            $figura = $files["imagem"]["name"];
            $caminho_imagem = $diretorio;
            if (file_exists($caminho_imagem)) {
                $novoNome = uniqid() . $figura;
                $figura = $novoNome;
            }
            move_uploaded_file($files["imagem"]["tmp_name"], $caminho_imagem . "/" . $figura);
        }
        $usuario = new Usuario();
        $dados['imagem'] = $figura;
        foreach ($dados as $chave => $valor) {
            $usuario->set($chave, $valor);
        }
        $usuarioDao = new UsuarioDao();
        $ret = $usuarioDao->alterar($usuario);
        echo $this->Success("Usuario", "Alterado", "Listar");
    }

    // Função responsavel por encerrar as sessões de login dos usuários.

    function sair()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        header("location:index.php");
    }
    
}
