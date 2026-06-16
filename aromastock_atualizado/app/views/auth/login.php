<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Login - AromaStock</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f0df;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .login-card {
            width: 600px;
            background-color: #fffaf0;
            border: 1px solid #111;
            padding: 30px;
        }

        .logo {
            width: 180px;
            display: block;
            margin: 0 auto 20px auto;
        }

        h2 {
            text-align: center;
            color: #111;
        }

        .subtitulo {
            text-align: center;
            margin-bottom: 30px;
        }

        .campo {
            margin-bottom: 20px;
        }

        .campo label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #111;
        }

        .campo input {
            width: 100%;
            height: 45px;
            padding: 10px;
            border: 1px solid #999;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .btn-login {
            width: 100%;
            background: #111 !important;
        }

        .credenciais {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="login-card">

        <img src="assets/logo.svg" class="logo" alt="Logo AromaStock">

        <h2>AromaStock</h2>

        <p class="subtitulo">
            Sistema de Estoque de Perfumes
        </p>

        <?php if (isset($erro)): ?>
            <p class="red-text center"><?= $erro ?></p>
        <?php endif; ?>

        <form method="POST" action="index.php?controller=auth&action=entrar">

            <div class="campo">
                <label>Login</label>
                <input type="text" name="login" required>
            </div>

            <div class="campo">
                <label>Senha</label>
                <input type="password" name="senha" required>
            </div>

            <button type="submit" class="btn btn-login">
                ENTRAR
            </button>

        </form>

        <div class="credenciais">
            Login: <b>admin</b> | Senha: <b>123</b>
        </div>

    </div>

</body>

</html>
