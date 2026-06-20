<?php require "../app/views/layout/header.php"; ?>

<?php
$categoria = $categoria ?? null;
?>

<h4>Editar Categoria</h4>

<?php if (!$categoria): ?>

    <div class="card-panel red lighten-4 red-text text-darken-4">
        Categoria não encontrada.
    </div>

    <a href="index.php?controller=categoria&action=index" class="btn">
        Voltar
    </a>

<?php else: ?>

<div class="card">
    <div class="card-content">

        <form method="POST" action="index.php?controller=categoria&action=atualizar">

            <input type="hidden" name="id" value="<?= $categoria['id'] ?>">

            <div class="input-field">
                <input type="text" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required>
                <label class="active">Nome da categoria</label>
            </div>

            <button type="submit" class="btn">
                Atualizar Categoria
            </button>

            <a href="index.php?controller=categoria&action=index" class="btn grey">
                Cancelar
            </a>

        </form>

    </div>
</div>

<?php endif; ?>

<?php require "../app/views/layout/footer.php"; ?>