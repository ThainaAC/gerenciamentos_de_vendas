<?php require "../app/views/layout/header.php"; ?>

<?php
$vendas = $vendas ?? [];
?>

<h4>Relatório de Vendas</h4>

<?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'venda_atualizada'): ?>
    <div class="card-panel green lighten-4 green-text text-darken-4">
        Venda atualizada com sucesso.
    </div>
<?php endif; ?>

<?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'venda_excluida'): ?>
    <div class="card-panel green lighten-4 green-text text-darken-4">
        Venda excluída com sucesso.
    </div>
<?php endif; ?>

<?php if (isset($_GET['erro'])): ?>
    <div class="card-panel red lighten-4 red-text text-darken-4">
        Erro ao processar venda.
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-content">
        <p>
            Nesta tela aparecem todas as vendas registradas no sistema.
            Você pode visualizar os detalhes, editar ou excluir uma venda.
        </p>
    </div>
</div>

<table class="striped responsive-table">
    <thead>
        <tr>
            <th>Código</th>
            <th>Cliente</th>
            <th>Data da Venda</th>
            <th>Total</th>
            <th>Ações</th>
        </tr>
    </thead>

    <tbody>
        <?php if (count($vendas) == 0): ?>
            <tr>
                <td colspan="5" class="center">
                    Nenhuma venda registrada.
                </td>
            </tr>
        <?php endif; ?>

        <?php foreach ($vendas as $venda): ?>
            <tr>
                <td><?= $venda['id'] ?></td>

                <td><?= htmlspecialchars($venda['cliente']) ?></td>

                <td><?= date('d/m/Y', strtotime($venda['data_venda'])) ?></td>

                <td>
                    R$ <?= number_format($venda['total'], 2, ',', '.') ?>
                </td>

                <td>
                    <a class="btn"
                       href="index.php?controller=venda&action=detalhes&id=<?= $venda['id'] ?>">
                        Detalhes
                    </a>

                    <a class="btn blue"
                       href="index.php?controller=venda&action=editar&id=<?= $venda['id'] ?>">
                        Editar
                    </a>

                    <a class="btn red"
                       href="index.php?controller=venda&action=excluir&id=<?= $venda['id'] ?>"
                       onclick="return confirm('Deseja realmente excluir esta venda?')">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require "../app/views/layout/footer.php"; ?>