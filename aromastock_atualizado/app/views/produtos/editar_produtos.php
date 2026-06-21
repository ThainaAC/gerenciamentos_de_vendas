<?php require "../app/views/layout/header.php"; ?>

<?php
$produto = $produto ?? null;
$categorias = $categorias ?? [];
?>

<h4>Editar Produto</h4>

<?php if (!$produto): ?>

    <div class="card-panel red lighten-4 red-text text-darken-4">
        Produto não encontrado.
    </div>

    <a href="index.php?controller=produto&action=index" class="btn">
        Voltar
    </a>

<?php else: ?>

<div class="card">
    <div class="card-content">

        <form method="POST" action="index.php?controller=produto&action=atualizar">

            <input type="hidden" name="id" value="<?= $produto['id'] ?>">

            <div class="input-field">
                <select name="categoria_id" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id'] ?>"
                            <?= $categoria['id'] == $produto['categoria_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($categoria['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Categoria</label>
            </div>

            <div class="input-field">
                <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>
                <label class="active">Nome do perfume</label>
            </div>

            <div class="input-field">
                <input type="text" name="descricao" value="<?= htmlspecialchars($produto['descricao']) ?>">
                <label class="active">Descrição</label>
            </div>

            <div class="input-field">
                <input type="number" name="quantidade" min="0" value="<?= $produto['quantidade'] ?>" required>
                <label class="active">Quantidade</label>
            </div>

            <div class="input-field">
                <input type="number" step="0.01" name="preco_compra" min="0" value="<?= $produto['preco_compra'] ?>" required>
                <label class="active">Preço de compra</label>
            </div>

            <button type="submit" class="btn">
                Atualizar Produto
            </button>

            <a href="index.php?controller=produto&action=index" class="btn grey">
                Cancelar
            </a>

        </form>

    </div>
</div>

<?php endif; ?>

<?php require "../app/views/layout/footer.php"; ?>