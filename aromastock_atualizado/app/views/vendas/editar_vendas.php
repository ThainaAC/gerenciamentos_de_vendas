<?php require "../app/views/layout/header.php"; ?>

<?php
$venda = $venda ?? null;
$clientes = $clientes ?? [];
$produtos = $produtos ?? [];
?>

<h4>Editar Venda</h4>

<?php if (!$venda): ?>

    <div class="card-panel red lighten-4 red-text text-darken-4">
        Venda não encontrada.
    </div>

    <a href="index.php?controller=venda&action=relatorio" class="btn">
        Voltar
    </a>

<?php else: ?>

<div class="card">
    <div class="card-content">

        <form method="POST" action="index.php?controller=venda&action=atualizar">

            <input type="hidden" name="id" value="<?= $venda['id'] ?>">

            <div class="input-field">
                <select name="cliente_id" required>
                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente['id'] ?>"
                            <?= $cliente['id'] == $venda['cliente_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cliente['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Cliente</label>
            </div>

            <div class="input-field">
                <select name="produto_id" required>
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto['id'] ?>"
                            <?= $produto['id'] == $venda['produto_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($produto['nome']) ?>
                            - R$ <?= number_format($produto['preco_venda'], 2, ',', '.') ?>
                            - Estoque: <?= $produto['quantidade'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Produto</label>
            </div>

            <div class="input-field">
                <input type="number"
                       name="quantidade"
                       min="1"
                       value="<?= $venda['quantidade'] ?>"
                       required>
                <label class="active">Quantidade</label>
            </div>

            <div class="input-field">
                <input type="date"
                       name="data_venda"
                       value="<?= $venda['data_venda'] ?>"
                       required>
                <label class="active">Data da venda</label>
            </div>

            <button type="submit" class="btn">
                Atualizar Venda
            </button>

            <a href="index.php?controller=venda&action=relatorio" class="btn grey">
                Cancelar
            </a>

        </form>

    </div>
</div>

<?php endif; ?>

<?php require "../app/views/layout/footer.php"; ?>