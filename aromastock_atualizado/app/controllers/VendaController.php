<?php

require_once "../app/models/Venda.php";
require_once "../app/models/Produto.php";
require_once "../app/models/Cliente.php";

class VendaController
{
    public function form()
    {
        Auth::verificar();

        $clientes = Cliente::listar();
        $produtos = Produto::listar();

        require "../app/views/vendas/form.php";
    }

    public function registrar()
    {
        Auth::verificar();

        $cliente_id = $_POST['cliente_id'] ?? "";
        $produto_id = $_POST['produto_id'] ?? "";
        $quantidade = $_POST['quantidade'] ?? "";
        $data_venda = $_POST['data_venda'] ?? "";

        if (
            Validator::inteiroPositivo($cliente_id) &&
            Validator::inteiroPositivo($produto_id) &&
            Validator::inteiroPositivo($quantidade) &&
            Validator::dataHoje($data_venda)
        ) {
            $resultado = Venda::registrar(
                $cliente_id,
                $produto_id,
                $quantidade,
                $data_venda
            );

            if ($resultado === true) {
                $sucesso = "Venda registrada com sucesso.";
            } else {
                $erro = $resultado;
            }
        } else {
            $erro = "A venda só pode ser registrada com a data de hoje.";
        }

        $clientes = Cliente::listar();
        $produtos = Produto::listar();

        require "../app/views/vendas/form.php";
    }

    public function relatorio()
    {
        Auth::verificar();

        $vendas = Venda::listar();

        require "../app/views/vendas/relatorio.php";
    }

    public function editar()
    {
        Auth::verificar();

        $id = $_GET['id'] ?? 0;

        $venda = Venda::listarPorId($id);
        $clientes = Cliente::listar();
        $produtos = Produto::listar();

        require "../app/views/vendas/editar_vendas.php";
    }

    public function atualizar()
    {
        Auth::verificar();

        $id = $_POST['id'] ?? "";
        $cliente_id = $_POST['cliente_id'] ?? "";
        $produto_id = $_POST['produto_id'] ?? "";
        $quantidade = $_POST['quantidade'] ?? "";
        $data_venda = $_POST['data_venda'] ?? "";

        if (
            Validator::inteiroPositivo($id) &&
            Validator::inteiroPositivo($cliente_id) &&
            Validator::inteiroPositivo($produto_id) &&
            Validator::inteiroPositivo($quantidade) &&
            Validator::dataHoje($data_venda)
        ) {
            $resultado = Venda::atualizar(
                $id,
                $cliente_id,
                $produto_id,
                $quantidade,
                $data_venda
            );

            if ($resultado !== true) {
                header("Location: index.php?controller=venda&action=relatorio&erro=" . urlencode($resultado));
                exit;
            }

            header("Location: index.php?controller=venda&action=relatorio&sucesso=venda_atualizada");
            exit;
        }

        header("Location: index.php?controller=venda&action=relatorio&erro=data_invalida");
        exit;
    }

    public function excluir()
    {
        Auth::verificar();

        $id = $_GET['id'] ?? 0;

        $resultado = Venda::excluir($id);

        if ($resultado !== true) {
            header("Location: index.php?controller=venda&action=relatorio&erro=" . urlencode($resultado));
            exit;
        }

        header("Location: index.php?controller=venda&action=relatorio&sucesso=venda_excluida");
        exit;
    }

    public function detalhes()
    {
        Auth::verificar();

        $id = $_GET['id'] ?? 0;

        $venda = Venda::buscar($id);
        $itens = Venda::itens($id);

        require "../app/views/vendas/detalhes.php";
    }
}
?>
