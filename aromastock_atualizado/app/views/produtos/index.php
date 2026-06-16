<?php require "../app/views/layout/header.php"; ?>

<h4>Produtos</h4>

<div class="card">
    <div class="card-content">
        <form method="POST" action="index.php?controller=produto&action=salvar">

            <div class="input-field">
                <select name="categoria_id" required>
                    <option value="" disabled selected>Selecione uma categoria</option>

                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id'] ?>">
                            <?= htmlspecialchars($categoria['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Categoria</label>
            </div>

            <div class="input-field">
                <input type="text" name="nome" required>
                <label>Nome do perfume</label>
            </div>

            <div class="input-field">
                <input type="text" name="descricao">
                <label>Descrição</label>
            </div>

            <div class="input-field">
                <input type="number" name="quantidade" min="0" required>
                <label>Quantidade inicial</label>
            </div>

            <div class="input-field">
                <input type="number" step="0.01" name="preco_compra" min="0" required>
                <label>Preço de compra</label>
            </div>

            <button type="submit" class="btn">Salvar Produto</button>
        </form>
    </div>
</div>

<table class="striped responsive-table">
    <thead>
        <tr>
            <th>Perfume</th>
            <th>Categoria</th>
            <th>Quantidade</th>
            <th>Preço Compra</th>
            <th>Preço Venda</th>
            <th>Ação</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?= htmlspecialchars($produto['nome']) ?></td>
                <td><?= htmlspecialchars($produto['categoria']) ?></td>
                <td><?= $produto['quantidade'] ?></td>
                <td>R$ <?= number_format($produto['preco_compra'], 2, ',', '.') ?></td>
                <td>R$ <?= number_format($produto['preco_venda'], 2, ',', '.') ?></td>
                <td>
                    <a class="btn red" href="index.php?controller=produto&action=excluir&id=<?= $produto['id'] ?>">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require "../app/views/layout/footer.php"; ?>
