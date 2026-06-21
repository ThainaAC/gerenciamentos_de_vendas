<?php

class Movimentacao {
    public static function registrar($produto_id, $tipo, $quantidade, $preco_compra, $data, $observacao) {
        $produto = Produto::listar($produto_id);

        if (!$produto) {
            return "Produto não encontrado.";
        }

        if ($tipo == "SAIDA" && $produto['quantidade'] < $quantidade) {
            return "Estoque insuficiente para realizar a saída.";
        }

        $db = Database::conectar();

        try {
            $db->beginTransaction();

            if ($tipo == "ENTRADA") {
                Produto::atualizarEstoqueEPreco($produto_id, $quantidade, $preco_compra);
            } else {
                Produto::atualizarEstoque($produto_id, -$quantidade);
                $preco_compra = null;
            }

            $sql = "INSERT INTO movimentacoes 
                    (produto_id, tipo, quantidade, preco_compra, data_movimentacao, observacao)
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->execute([$produto_id, $tipo, $quantidade, $preco_compra, $data, $observacao]);

            $db->commit();
            return true;

        } catch (Exception $e) {
            $db->rollBack();
            return "Erro ao registrar movimentação: " . $e->getMessage();
        }
    }
}
