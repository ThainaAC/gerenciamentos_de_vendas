<?php

class Venda {
    public static function registrar($cliente_id, $produto_id, $quantidade, $data_venda) {
        $produto = Produto::listarPorId($produto_id);

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

    public static function listarPorId($id) {
        $db = Database::conectar();

        $sql = "SELECT v.id, v.cliente_id, v.data_venda, v.total,
                       i.produto_id, i.quantidade
                FROM vendas v
                INNER JOIN itens_venda i ON v.id = i.venda_id
                WHERE v.id = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function atualizar($id, $cliente_id, $produto_id, $quantidade, $data_venda) {
        $db = Database::conectar();

        try {
            $db->beginTransaction();

            $stmt = $db->prepare("SELECT produto_id, quantidade FROM itens_venda WHERE venda_id = ?");
            $stmt->execute([$id]);
            $itemAntigo = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$itemAntigo) {
                $db->rollBack();
                return "Item da venda não encontrado.";
            }

            $produtoAntigoId = $itemAntigo['produto_id'];
            $quantidadeAntiga = $itemAntigo['quantidade'];

            $stmt = $db->prepare("UPDATE produtos SET quantidade = quantidade + ? WHERE id = ?");
            $stmt->execute([$quantidadeAntiga, $produtoAntigoId]);

            $stmt = $db->prepare("SELECT * FROM produtos WHERE id = ?");
            $stmt->execute([$produto_id]);
            $produtoNovo = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$produtoNovo) {
                $db->rollBack();
                return "Produto não encontrado.";
            }

            if ($produtoNovo['quantidade'] < $quantidade) {
                $db->rollBack();
                return "Estoque insuficiente para atualizar a venda.";
            }

            $preco_unitario = $produtoNovo['preco_venda'];
            $subtotal = $preco_unitario * $quantidade;

            $stmt = $db->prepare("UPDATE vendas
                                  SET cliente_id = ?, data_venda = ?, total = ?
                                  WHERE id = ?");
            $stmt->execute([$cliente_id, $data_venda, $subtotal, $id]);

            $stmt = $db->prepare("UPDATE itens_venda
                                  SET produto_id = ?, quantidade = ?, preco_unitario = ?, subtotal = ?
                                  WHERE venda_id = ?");
            $stmt->execute([$produto_id, $quantidade, $preco_unitario, $subtotal, $id]);

            $stmt = $db->prepare("UPDATE produtos SET quantidade = quantidade - ? WHERE id = ?");
            $stmt->execute([$quantidade, $produto_id]);

            $db->commit();
            return true;

        } catch (Exception $e) {
            $db->rollBack();
            return "Erro ao atualizar venda: " . $e->getMessage();
        }
    }

    public static function excluir($id) {
        $db = Database::conectar();

        try {
            $db->beginTransaction();

            $stmt = $db->prepare("SELECT produto_id, quantidade FROM itens_venda WHERE venda_id = ?");
            $stmt->execute([$id]);
            $itens = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($itens as $item) {
                $stmtEstoque = $db->prepare("UPDATE produtos SET quantidade = quantidade + ? WHERE id = ?");
                $stmtEstoque->execute([$item['quantidade'], $item['produto_id']]);
            }

            $stmt = $db->prepare("DELETE FROM itens_venda WHERE venda_id = ?");
            $stmt->execute([$id]);

            $stmt = $db->prepare("DELETE FROM vendas WHERE id = ?");
            $stmt->execute([$id]);

            $db->commit();
            return true;

        } catch (Exception $e) {
            $db->rollBack();
            return "Erro ao excluir venda: " . $e->getMessage();
        }
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
?>