<?php

class Venda {
    public static function registrar($cliente_id, $produto_id, $quantidade, $data_venda) {
        $produto = Produto::buscar($produto_id);

        if (!$produto) {
            return "Produto não encontrado.";
        }

        if ($produto['quantidade'] < $quantidade) {
            return "Estoque insuficiente para realizar a venda.";
        }

        $db = Database::conectar();

        try {
            $db->beginTransaction();

            $preco_unitario = $produto['preco_venda'];
            $subtotal = $preco_unitario * $quantidade;

            $sqlVenda = "INSERT INTO vendas (cliente_id, data_venda, total)
                         VALUES (?, ?, ?)";
            $stmtVenda = $db->prepare($sqlVenda);
            $stmtVenda->execute([$cliente_id, $data_venda, $subtotal]);

            $venda_id = $db->lastInsertId();

            $sqlItem = "INSERT INTO itens_venda
                        (venda_id, produto_id, quantidade, preco_unitario, subtotal)
                        VALUES (?, ?, ?, ?, ?)";
            $stmtItem = $db->prepare($sqlItem);
            $stmtItem->execute([$venda_id, $produto_id, $quantidade, $preco_unitario, $subtotal]);

            Produto::atualizarEstoque($produto_id, -$quantidade);

            $db->commit();
            return true;

        } catch (Exception $e) {
            $db->rollBack();
            return "Erro ao registrar venda: " . $e->getMessage();
        }
    }

    public static function listar() {
        $db = Database::conectar();

        $sql = "SELECT v.id, v.data_venda, v.total, c.nome AS cliente
                FROM vendas v
                INNER JOIN clientes c ON v.cliente_id = c.id
                ORDER BY v.id DESC";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function buscar($id) {
        $db = Database::conectar();

        $sql = "SELECT v.id, v.data_venda, v.total, c.nome AS cliente, c.email, c.telefone
                FROM vendas v
                INNER JOIN clientes c ON v.cliente_id = c.id
                WHERE v.id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function itens($venda_id) {
        $db = Database::conectar();

        $sql = "SELECT i.*, p.nome AS produto
                FROM itens_venda i
                INNER JOIN produtos p ON i.produto_id = p.id
                WHERE i.venda_id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$venda_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
