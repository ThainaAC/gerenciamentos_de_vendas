<?php require "../app/views/layout/header.php"; ?>

<?php
$produtos = $produtos ?? [];
?>

<h4>Entrada e Saída de Estoque</h4>

<?php if (isset($erro)): ?>
    <p class="red-text"><?= $erro ?></p>
<?php endif; ?>

<?php if (isset($sucesso)): ?>
    <p class="green-text"><?= $sucesso ?></p>
<?php endif; ?>

<div class="card">
    <div class="card-content">
        <form method="POST" action="index.php?controller=movimentacao&action=registrar">

            <div class="input-field">
                <select name="produto_id" required>
                    <option value="" disabled selected>Selecione um produto</option>

                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto['id'] ?>">
                            <?= htmlspecialchars($produto['nome']) ?> - Estoque atual: <?= $produto['quantidade'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Produto</label>
            </div>

            <div class="input-field">
                <select name="tipo" required>
                    <option value="" disabled selected>Selecione o tipo</option>
                    <option value="ENTRADA">Entrada</option>
                    <option value="SAIDA">Saída</option>
                </select>
                <label>Tipo de movimentação</label>
            </div>

            <div class="input-field">
                <input type="number" name="quantidade" min="1" required>
                <label>Quantidade</label>
            </div>

            <div class="input-field">
                <input type="number" step="0.01" name="preco_compra" min="0">
                <label>Preço de compra, obrigatório em entrada</label>
            </div>

            <div class="input-field">
                <input type="date" name="data_movimentacao" required>
                <label>Data da movimentação</label>
            </div>

            <div class="input-field">
                <input type="text" name="observacao">
                <label>Observação</label>
            </div>

            <button type="submit" class="btn">Registrar Movimentação</button>
        </form>
    </div>
</div>

<?php require "../app/views/layout/footer.php"; ?>