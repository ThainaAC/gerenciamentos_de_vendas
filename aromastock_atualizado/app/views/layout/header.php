<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>AromaStock</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            background-color: #f5f0df;
            color: #111111;

            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        nav,
        .btn,
        .btn-large {
            background-color: #111111 !important;
        }

        nav a {
            color: #f5f0df !important;
        }

        .brand-logo {
            margin-left: 15px;
            font-weight: bold;
        }

        .card {
            background-color: #fffaf0;
            border: 1px solid #111111;
        }

        h4,
        h5,
        label {
            color: #111111;
        }

        table.striped>tbody>tr:nth-child(odd) {
            background-color: #eee3c8;
        }

        .logo-home {
            width: 200px;
            margin: 20px auto;
            display: block;
        }

        .page-footer {
            background-color: #111111 !important;
            color: white;
            padding: 15px 0;
        }
    </style>
</head>

<body>

    <?php if (isset($_SESSION['usuario_id'])): ?>
        <nav>
            <div class="nav-wrapper">
                <a href="index.php?controller=home&action=index" class="brand-logo">
                    AromaStock
                </a>

                <ul class="right hide-on-med-and-down">
                    <li><a href="index.php?controller=home&action=index">Home</a></li>
                    <li><a href="index.php?controller=cliente&action=index">Clientes</a></li>
                    <li><a href="index.php?controller=categoria&action=index">Categorias</a></li>
                    <li><a href="index.php?controller=produto&action=index">Produtos</a></li>
                    <li><a href="index.php?controller=movimentacao&action=form">Movimentação</a></li>
                    <li><a href="index.php?controller=venda&action=form">Vendas</a></li>
                    <li><a href="index.php?controller=venda&action=relatorio">Relatório de Vendas</a></li>
                    <li><a href="index.php?controller=auth&action=logout">Sair</a></li>
                </ul>
            </div>
        </nav>
    <?php endif; ?>

    <main>
        <div class="container" style="margin-top: 30px;">
