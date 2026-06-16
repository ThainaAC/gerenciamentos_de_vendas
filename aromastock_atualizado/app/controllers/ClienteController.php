<?php

require_once "../app/models/Cliente.php";

class ClienteController
{
    public function index()
    {
        Auth::verificar();

        $clientes = Cliente::listar();

        require "../app/views/clientes/index.php";
    }

    public function salvar()
    {
        Auth::verificar();

        $nome = $_POST['nome'] ?? "";
        $email = $_POST['email'] ?? "";
        $telefone = $_POST['telefone'] ?? "";
        $endereco = $_POST['endereco'] ?? "";

        if (
            Validator::texto($nome) &&
            Validator::email($email) &&
            Validator::telefone($telefone) &&
            Validator::texto($endereco)
        ) {
            Cliente::salvar($nome, $email, $telefone, $endereco);
        }

        header("Location: index.php?controller=cliente&action=index");
        exit;
    }

    public function excluir()
    {
        Auth::verificar();

        $id = $_GET['id'] ?? 0;

        $resultado = Cliente::excluir($id);

        if ($resultado === false) {
            header("Location: index.php?controller=cliente&action=index&erro=cliente_com_venda");
            exit;
        }

        header("Location: index.php?controller=cliente&action=index&sucesso=cliente_excluido");
        exit;
    }
}
?>