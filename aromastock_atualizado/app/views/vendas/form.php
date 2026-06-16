<?php require "../app/views/layout/header.php"; ?>

<h4>Registrar Venda</h4>

<?php if (isset($erro)): ?>
    <p class="red-text"><?= $erro ?></p>
<?php endif; ?>

<?php if (isset($sucesso)): ?>
    <p class="green-text"><?= $sucesso ?></p>
<?php endif; ?>

<div class="card">
    <div class="card-content">
        <form method="POST" action="index.php?controller=venda&action=registrar">

            <div class="input-field">
                <select name="cliente_id" required>
                    <option value="" disabled selected>Selecione um cliente</option>

                    <?php foreach ($clientes as $cliente): ?>
                        <option value="<?= $cliente['id'] ?>">
                            <?= htmlspecialchars($cliente['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Cliente</label>
            </div>

            <div class="input-field">
                <select name="produto_id" required>
                    <option value="" disabled selected>Selecione um perfume</option>

                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto['id'] ?>">
                            <?= htmlspecialchars($produto['nome']) ?>
                            - R$ <?= number_format($produto['preco_venda'], 2, ',', '.') ?>
                            - Estoque: <?= $produto['quantidade'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Produto</label>
            </div>

            <div class="input-field">
                <input type="number" name="quantidade" min="1" required>
                <label>Quantidade</label>
            </div>

            <div class="input-field">
                <input type="date" name="data_venda" required>
                <label>Data da venda</label>
            </div>

            <button type="submit" class="btn">Finalizar Venda</button>
            <a href="index.php?controller=venda&action=relatorio" class="btn">Ver Relatório</a>
        </form>
    </div>
</div>

<?php require "../app/views/layout/footer.php"; ?>
