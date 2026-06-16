<?php

require_once "../app/models/Produto.php";
require_once "../app/models/Movimentacao.php";

class MovimentacaoController
{
    public function form()
    {
        Auth::verificar();

        $produtos = Produto::listar();

        require "../app/views/movimentacoes/form.php";
    }

    public function registrar()
    {
        Auth::verificar();

        $produto_id = $_POST['produto_id'] ?? "";
        $tipo = $_POST['tipo'] ?? "";
        $quantidade = $_POST['quantidade'] ?? "";
        $preco_compra = $_POST['preco_compra'] ?? "";
        $data = $_POST['data_movimentacao'] ?? "";
        $observacao = $_POST['observacao'] ?? "";

        if (
            Validator::inteiroPositivo($produto_id) &&
            in_array($tipo, ["ENTRADA", "SAIDA"]) &&
            Validator::inteiroPositivo($quantidade) &&
            Validator::data($data)
        ) {

            $anoInformado = date('Y', strtotime($data));
            $anoAtual = date('Y');

            if ($anoInformado != $anoAtual) {

                $erro = "A movimentação deve ser registrada no ano atual.";

            } elseif ($tipo == "ENTRADA" && !Validator::numero($preco_compra)) {

                $erro = "Para entrada é obrigatório informar o preço de compra.";

            } else {

                $resultado = Movimentacao::registrar(
                    $produto_id,
                    $tipo,
                    $quantidade,
                    $preco_compra,
                    $data,
                    $observacao
                );

                if ($resultado === true) {
                    $sucesso = "Movimentação registrada com sucesso.";
                } else {
                    $erro = $resultado;
                }
            }

        } else {

            $erro = "Dados inválidos.";

        }

        $produtos = Produto::listar();

        require "../app/views/movimentacoes/form.php";
    }
}
?>