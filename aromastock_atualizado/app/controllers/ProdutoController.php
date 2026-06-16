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

        if (
            Validator::inteiroPositivo($_POST['categoria_id'] ?? "") &&
            Validator::texto($_POST['nome'] ?? "") &&
            Validator::numero($_POST['quantidade'] ?? "") &&
            Validator::numero($_POST['preco_compra'] ?? "")
        ) {
            Produto::salvar(
                $_POST['categoria_id'],
                $_POST['nome'],
                $_POST['descricao'] ?? "",
                $_POST['quantidade'],
                $_POST['preco_compra']
            );
        }

        header("Location: index.php?controller=produto&action=index");
    }

    public function excluir() {
        Auth::verificar();
        Produto::excluir($_GET['id']);
        header("Location: index.php?controller=produto&action=index");
    }
}
