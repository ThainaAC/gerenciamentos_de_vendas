<?php

class Produto {
    public static function listar() {
        $db = Database::conectar();

        $sql = "SELECT p.*, c.nome AS categoria
                FROM produtos p
                INNER JOIN categorias c ON p.categoria_id = c.id
                ORDER BY p.nome";

        return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function listarPorId($id) {
        $db = Database::conectar();

        $stmt = $db->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function salvar($categoria_id, $nome, $descricao, $quantidade, $preco_compra) {
        $db = Database::conectar();

        $preco_venda = $preco_compra * 1.25;

        $sql = "INSERT INTO produtos 
                (categoria_id, nome, descricao, quantidade, preco_compra, preco_venda)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            $categoria_id,
            $nome,
            $descricao,
            $quantidade,
            $preco_compra,
            $preco_venda
        ]);
    }

    public static function atualizar($id, $categoria_id, $nome, $descricao, $quantidade, $preco_compra) {
        $db = Database::conectar();

        $preco_venda = $preco_compra * 1.25;

        $sql = "UPDATE produtos
                SET categoria_id = ?,
                    nome = ?,
                    descricao = ?,
                    quantidade = ?,
                    preco_compra = ?,
                    preco_venda = ?
                WHERE id = ?";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            $categoria_id,
            $nome,
            $descricao,
            $quantidade,
            $preco_compra,
            $preco_venda,
            $id
        ]);
    }

    public static function atualizarEstoque($id, $quantidade) {
        $db = Database::conectar();

        $stmt = $db->prepare("UPDATE produtos SET quantidade = quantidade + ? WHERE id = ?");
        return $stmt->execute([$quantidade, $id]);
    }

    public static function atualizarEstoqueEPreco($id, $quantidade, $preco_compra) {
        $db = Database::conectar();

        $preco_venda = $preco_compra * 1.25;

        $sql = "UPDATE produtos
                SET quantidade = quantidade + ?,
                    preco_compra = ?,
                    preco_venda = ?
                WHERE id = ?";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            $quantidade,
            $preco_compra,
            $preco_venda,
            $id
        ]);
    }

   
    public static function excluir($id) {
    $db = Database::conectar();

    $stmt = $db->prepare("SELECT COUNT(*) AS total FROM movimentacoes WHERE produto_id = ?");
    $stmt->execute([$id]);
    $movimentacoes = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($movimentacoes['total'] > 0) {
        return false;
    }

    $stmt = $db->prepare("SELECT COUNT(*) AS total FROM itens_venda WHERE produto_id = ?");
    $stmt->execute([$id]);
    $vendas = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($vendas['total'] > 0) {
        return false;
    }

    $stmt = $db->prepare("DELETE FROM produtos WHERE id = ?");
    return $stmt->execute([$id]);
}
}
?>
