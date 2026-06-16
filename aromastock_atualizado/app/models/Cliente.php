<?php

class Cliente {
    public static function listar() {
        $db = Database::conectar();
        return $db->query("SELECT * FROM clientes ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function salvar($nome, $email, $telefone, $endereco) {
        $db = Database::conectar();

        $sql = "INSERT INTO clientes (nome, email, telefone, endereco)
                VALUES (?, ?, ?, ?)";

        $stmt = $db->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone, $endereco]);
    }

    public static function excluir($id) {
        $db = Database::conectar();

        $stmt = $db->prepare("SELECT COUNT(*) AS total FROM vendas WHERE cliente_id = ?");
        $stmt->execute([$id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado['total'] > 0) {
            return false;
        }

        $stmt = $db->prepare("DELETE FROM clientes WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
