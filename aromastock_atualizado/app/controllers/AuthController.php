<?php

require_once "../app/models/Usuario.php";

class AuthController {
    public function login() {
        require "../app/views/auth/login.php";
    }

    public function entrar() {
        $login = $_POST['login'] ?? "";
        $senha = $_POST['senha'] ?? "";

        if (!Validator::texto($login) || !Validator::texto($senha)) {
            $erro = "Preencha login e senha.";
            require "../app/views/auth/login.php";
            return;
        }

        $usuario = Usuario::autenticar($login, $senha);

        if ($usuario) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header("Location: index.php?controller=home&action=index");
        } else {
            $erro = "Login ou senha incorretos.";
            require "../app/views/auth/login.php";
        }
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
    }
}
