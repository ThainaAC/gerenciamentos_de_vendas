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

    public function excluir() {
        Auth::verificar();
        Categoria::excluir($_GET['id']);
        header("Location: index.php?controller=categoria&action=index");
    }
}
