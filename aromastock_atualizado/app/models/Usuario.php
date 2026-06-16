<?php

class Usuario {
    public static function autenticar($login, $senha) {
        $db = Database::conectar();
        $sql = "SELECT * FROM usuarios WHERE login = ? AND senha = MD5(?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$login, $senha]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
