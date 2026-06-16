<?php

class Auth {
    public static function verificar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }
}
