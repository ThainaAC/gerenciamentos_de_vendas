<?php

require_once "../app/models/Produto.php";
require_once "../app/models/Categoria.php";

class ProdutoController {
    public function index() {
        Auth::verificar();

        $produtos = Produto::listar();
        $categorias = Categoria::listar();

        require "../app/views/produtos/index.php";
    }

    public function salvar() {
        Auth::verificar();

        $categoria_id = $_POST['categoria_id'] ?? "";
        $nome = $_POST['nome'] ?? "";
        $descricao = $_POST['descricao'] ?? "";
        $quantidade = $_POST['quantidade'] ?? "";
        $preco_compra = $_POST['preco_compra'] ?? "";

        if (
            Validator::inteiroPositivo($categoria_id) &&
            Validator::texto($nome) &&
            Validator::numero($quantidade) &&
            Validator::numero($preco_compra)
        ) {
            Produto::salvar(
                $categoria_id,
                $nome,
                $descricao,
                $quantidade,
                $preco_compra
            );
        }

        header("Location: index.php?controller=produto&action=index");
        exit;
    }

    public function editar() {
        Auth::verificar();

        $id = $_GET['id'] ?? 0;

        $produto = Produto::listarPorId($id);
        $categorias = Categoria::listar();

        require "../app/views/produtos/editar_produtos.php";
    }

    public function atualizar() {
        Auth::verificar();

        $id = $_POST['id'] ?? "";
        $categoria_id = $_POST['categoria_id'] ?? "";
        $nome = $_POST['nome'] ?? "";
        $descricao = $_POST['descricao'] ?? "";
        $quantidade = $_POST['quantidade'] ?? "";
        $preco_compra = $_POST['preco_compra'] ?? "";

        if (
            Validator::inteiroPositivo($id) &&
            Validator::inteiroPositivo($categoria_id) &&
            Validator::texto($nome) &&
            Validator::numero($quantidade) &&
            Validator::numero($preco_compra)
        ) {
            Produto::atualizar(
                $id,
                $categoria_id,
                $nome,
                $descricao,
                $quantidade,
                $preco_compra
            );
        }

        header("Location: index.php?controller=produto&action=index&sucesso=produto_atualizado");
        exit;
    }

    public function excluir() {
    Auth::verificar();

    $id = $_GET['id'] ?? 0;

    $resultado = Produto::excluir($id);

    if ($resultado === false) {
        header("Location: index.php?controller=produto&action=index&erro=produto_vinculado");
        exit;
    }

    header("Location: index.php?controller=produto&action=index&sucesso=produto_excluido");
    exit;
}
}
?>
