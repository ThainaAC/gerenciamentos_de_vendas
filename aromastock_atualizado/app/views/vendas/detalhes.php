<?php require "../app/views/layout/header.php"; ?>

<?php
$venda = $venda ?? null;
$itens = $itens ?? [];
?>

<h4>Detalhes da Venda</h4>

<?php if (!$venda): ?>
    <p class="red-text">Venda não encontrada.</p>
    <a href="index.php?controller=venda&action=relatorio" class="btn">Voltar</a>
<?php else: ?>

<div class="card">
    <div class="card-content">
        <h5>Dados da Venda</h5>

        <p><b>Código:</b> <?= $venda['id'] ?></p>
        <p><b>Cliente:</b> <?= htmlspecialchars($venda['cliente']) ?></p>
        <p><b>E-mail:</b> <?= htmlspecialchars($venda['email']) ?></p>
        <p><b>Telefone:</b> <?= htmlspecialchars($venda['telefone']) ?></p>
        <p><b>Data:</b> <?= date('d/m/Y', strtotime($venda['data_venda'])) ?></p>
        <p><b>Total:</b> R$ <?= number_format($venda['total'], 2, ',', '.') ?></p>
    </div>
</div>

<h5>Produtos Vendidos</h5>

<table class="striped responsive-table">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Subtotal</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($itens as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['produto']) ?></td>
                <td><?= $item['quantidade'] ?></td>
                <td>R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format($item['subtotal'], 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<br>

<a href="index.php?controller=venda&action=relatorio" class="btn">Voltar ao Relatório</a>

<?php endif; ?>

<?php require "../app/views/layout/footer.php"; ?>
