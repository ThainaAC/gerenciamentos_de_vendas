<?php

require_once "../app/models/Venda.php";
require_once "../app/models/Produto.php";
require_once "../app/models/Cliente.php";

class VendaController {
    public function form() {
        Auth::verificar();

        $clientes = Cliente::listar();
        $produtos = Produto::listar();

        require "../app/views/vendas/form.php";
    }

    public function registrar() {
        Auth::verificar();

        if (
            Validator::inteiroPositivo($_POST['cliente_id'] ?? "") &&
            Validator::inteiroPositivo($_POST['produto_id'] ?? "") &&
            Validator::inteiroPositivo($_POST['quantidade'] ?? "") &&
            Validator::data($_POST['data_venda'] ?? "")
        ) {
            $resultado = Venda::registrar(
                $_POST['cliente_id'],
                $_POST['produto_id'],
                $_POST['quantidade'],
                $_POST['data_venda']
            );

            if ($resultado === true) {
                $sucesso = "Venda registrada com sucesso.";
            } else {
                $erro = $resultado;
            }
        } else {
            $erro = "Dados inválidos.";
        }

        $clientes = Cliente::listar();
        $produtos = Produto::listar();

        require "../app/views/vendas/form.php";
    }

    public function relatorio() {
        Auth::verificar();

        $vendas = Venda::listar();

        require "../app/views/vendas/relatorio.php";
    }

    public function detalhes() {
        Auth::verificar();

        $id = $_GET['id'] ?? 0;

        $venda = Venda::buscar($id);
        $itens = Venda::itens($id);

        require "../app/views/vendas/detalhes.php";
    }
}
