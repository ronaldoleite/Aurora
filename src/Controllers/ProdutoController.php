<?php
namespace App\Controllers;
use App\Models\Produto;
use App\Models\ProdutoDao;
use App\Models\CategoriaDao;
use App\Models\FornecedorDao;
use App\Models\Notifications;

class ProdutoController extends Notifications
{
    public  function Index()
    {
        $cat = new CategoriaDao();
        $getCat = $cat->Listar();

        $fornec = new FornecedorDao();
        $getFornec = $fornec->Listar();
        // Função para recuperar os dados do usuário que será editado.
        $id = "";
        if ($_GET && isset($_GET['id'])) {

            $id = $_GET['id'];
            $obterUm = new ProdutoDao();
            $return = $obterUm->ObterUm($id);
            require_once "Views/Painel/Index.php";
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

        $obj = new ProdutoDao();
        $ret = $obj->Listar();

        require_once "Views/Painel/Index.php";
    }

    // metodo responsavel por inserir novos registros no banco de dados

    function Inserir($dados, $files)
    {

        $figura = "";
        $diretorio = "lib/img/upload";

        if ($files["imagem"]["name"] != "") {
            $figura = $files["imagem"]["name"];
            $caminho_imagem = $diretorio;
            if (file_exists($caminho_imagem)) {
                $novoNome = uniqid() . $figura;
                $figura = $novoNome;
            }
            move_uploaded_file($files["imagem"]["tmp_name"], $caminho_imagem . "/" . $figura);

            $dados['imagem'] = $figura;


            $objDao = new ProdutoDAO();
            $max = $objDao->UltimoCodigo();
            $codigo = (int) $max[0]->ULTIMO;
            if (count($max) > 0 && $max != "") {
                $newCodigo = str_pad($codigo + 1, '5', '0', STR_PAD_LEFT);
            } else {
                $newCodigo = '00001';
            }
            $dados['codigo'] = $newCodigo;
            $dataCadastro = date('Y-m-d H:i:s');
            $dados['datacadastro'] = $dataCadastro;
            $prod = new Produto();
            foreach ($dados as $chave => $valor) {
                $prod->set($chave, $valor);
            }
            $obj = new ProdutoDao();
            $ret = $obj->Adicionar($prod);
            echo $this->Success("Produto", "Cadastrado", "Listar");
        }
    }

    // Metodo responsavel por alterar os dados de um estabelecimento no baco de dados

    function Alterar($dados, $files)
    {
        $figura = "";
        $diretorio = "lib/img/upload";

        if ($files["imagem"]["name"] != "") {
            $figura = $files["imagem"]["name"];
            $caminho_imagem = $diretorio;
            if (file_exists($caminho_imagem)) {
                $novoNome = uniqid() . $figura;
                $figura = $novoNome;
            }
            move_uploaded_file($files["imagem"]["tmp_name"], $caminho_imagem . "/" . $figura);
        }
        $prod = new Produto();
        $dados['imagem'] = $figura;
        foreach ($dados as $chave => $valor) {
            $prod->set($chave, $valor);
        }
        $obj = new ProdutoDao();
        $ret = $obj->Alterar($prod);
        echo $this->Success("Produto", "Atualizado", "Listar");
    }

    public function Listar()
    {
        $obj = new ProdutoDao();
        $ret = $obj->Listar();
        require_once "Views/Painel/Index.php";
    }
    // metodo responsavel por validar a decisão do usuário ao excluir um Estabelecimento
    public function DeleteConfirm()
    {
        $id = [];
        if ($_GET) {
            $id = $_GET['id'];
        }
        echo $this->Confirm("Excluir", "Produto", "", $id);

        require_once "Views/Shared/Header.php";
    }

    // Função responsavel por excluir um estabelecimento

    public function Delete()
    {
        $id = [];
        $id = $_GET['id'];
        $obj = new ProdutoDao();
        $ret = $obj->Deletar($id);
        echo $this->Success("Produto", "Excluido", "Listar");
        require_once "Views/Shared/Header.php";
    }

    function AtivarProduto()
    {
        $id = "";
        $acao = "";
        if ($_GET) {

            $id = $_GET['id'];
            $acao = $_GET['acao'];

            switch ($acao) {
                case 'A':
                    
                    $prodDAO = new ProdutoDAO();
                    $prodDAO->AtivarProduto($acao,$id);
                    header("Location:index.php?controle=ProdutoControle&metodo=ObterTodos");
                    break;
                case 'I':
                   $prodDAO = new ProdutoDAO();
                   $prodDAO->AtivarProduto($acao,$id);
                    header("Location:index.php?controle=ProdutoControle&metodo=ObterTodos");
                    break;
            }
            echo "<h1 style='font-size:150px;'>";
            var_dump($acao);
            echo "</h1>";
        }

        require_once 'src/Views/listar-produtos.php';
    }
}
