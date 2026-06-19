<?php

require_once "../app/models/Categoria.php";

class CategoriaController {
    public function index() {
        Auth::verificar();
        $categorias = Categoria::listar();
        require "../app/views/categorias/index.php";
    }

    public function salvar() {
        Auth::verificar();

        if (Validator::texto($_POST['nome'] ?? "")) {
            Categoria::salvar($_POST['nome']);
        }

        header("Location: index.php?controller=categoria&action=index");
    }

      public function editar() {
        Auth::verificar();

        $id = $_GET['id'] ?? 0;

        $categoria = Categoria::listarPorId($id);

        require "../app/views/categorias/editar_categorias.php";
    }

       public function atualizar() {
        Auth::verificar();

        $id = $_POST['id'] ?? "";
        $nome = $_POST['nome'] ?? "";

        if (
            Validator::inteiroPositivo($id) &&
            Validator::texto($nome)
        ) {
            Categoria::atualizar($id, $nome);
        }

        header("Location: index.php?controller=categoria&action=index&sucesso=categoria_atualizada");
        exit;
    }

    public function excluir() {
        Auth::verificar();
        Categoria::excluir($_GET['id']);
        header("Location: index.php?controller=categoria&action=index");
    }
}
