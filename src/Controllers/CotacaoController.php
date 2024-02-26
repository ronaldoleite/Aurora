<?php
namespace App\Controllers;
use App\Models\Notifications;
use App\Models\PerfilDao;
use App\Models\Usuario;
use App\Models\UsuarioDao;

class CotacaoController extends Notifications
{
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
      require_once "Views/Usuario/Adicionar.php";
    }

    if ($_POST) {

      $dados = $_POST;
      $files = $_FILES;
      if ($dados['id'] == '') {
        $this->inserir($dados, $files);
      } else {
        $this->alterar($dados, $files);
      }
    }

    $usuDao = new UsuarioDao();
    $ret = $usuDao->ListarTodos();

    if (is_string($ret)) {
      echo "<div class='alert alert-danger'>{$ret}</div>";
    }
    require_once "Views/Usuario/Adicionar.php";
  }

  // Função responsavel por inserir um usuário

  function inserir($dados, $files)
  {
    $figura = "";
    //$user = $dados['usuario'];
    // $diretorio = "lib/img/users-images/{$user}";
    $diretorio = "lib/img/users-images";
    /*if (!is_dir($diretorio)) {
          mkdir("lib/img/users-images/{$user}");
      }*/

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
      echo $this->Success("Usuario", "Cadastrado", "Index");
    }
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
    echo $this->Success("Usuario", "Alterado", "Index");
  }
}
