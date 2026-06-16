<?php

class Categoria {
    public static function listar() {
        $db = Database::conectar();
        return $db->query("SELECT * FROM categorias ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function salvar($nome) {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO categorias (nome) VALUES (?)");
        return $stmt->execute([$nome]);
    }

    public static function excluir($id) {
        $db = Database::conectar();
        $stmt = $db->prepare("DELETE FROM categorias WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
