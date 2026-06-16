<?php require "../app/views/layout/header.php"; ?>

<h4>Categorias</h4>

<div class="card">
    <div class="card-content">
        <form method="POST" action="index.php?controller=categoria&action=salvar">
            <div class="input-field">
                <input type="text" name="nome" required>
                <label>Nome da categoria</label>
            </div>

            <button type="submit" class="btn">Salvar Categoria</button>
        </form>
    </div>
</div>

<table class="striped responsive-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Categoria</th>
            <th>Ação</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($categorias as $categoria): ?>
            <tr>
                <td><?= $categoria['id'] ?></td>
                <td><?= htmlspecialchars($categoria['nome']) ?></td>
                <td>
                    <a class="btn red" href="index.php?controller=categoria&action=excluir&id=<?= $categoria['id'] ?>">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require "../app/views/layout/footer.php"; ?>
