<?php require "../app/views/layout/header.php"; ?>

<h4>Relatório de Vendas</h4>

<div class="card">
    <div class="card-content">
        <p>
            Nesta tela aparecem todas as vendas registradas no sistema.
            Para ver os produtos vendidos, clique em detalhes.
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
            <th>Detalhes</th>
        </tr>
    </thead>

    <tbody>
        <?php if (count($vendas) == 0): ?>
            <tr>
                <td colspan="5" class="center">Nenhuma venda registrada.</td>
            </tr>
        <?php endif; ?>

        <?php foreach ($vendas as $venda): ?>
            <tr>
                <td><?= $venda['id'] ?></td>
                <td><?= htmlspecialchars($venda['cliente']) ?></td>
                <td><?= date('d/m/Y', strtotime($venda['data_venda'])) ?></td>
                <td>R$ <?= number_format($venda['total'], 2, ',', '.') ?></td>
                <td>
                    <a class="btn" href="index.php?controller=venda&action=detalhes&id=<?= $venda['id'] ?>">
                        Detalhes
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require "../app/views/layout/footer.php"; ?>
