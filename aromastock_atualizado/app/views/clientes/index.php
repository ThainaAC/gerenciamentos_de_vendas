<?php require "../app/views/layout/header.php"; ?>

<h4>Clientes</h4>



<?php if (isset($_GET['erro']) && $_GET['erro'] == 'cliente_com_venda'): ?>
    <div class="card-panel red lighten-4 red-text text-darken-4">
        Não é possível excluir este cliente, pois ele possui venda registrada.
    </div>
<?php endif; ?>

<?php if (isset($_GET['sucesso']) && $_GET['sucesso'] == 'cliente_excluido'): ?>
    <div class="card-panel green lighten-4 green-text text-darken-4">
        Cliente excluído com sucesso.
    </div>
<?php endif; ?>

<div class="card">
    <div class="card-content">
        <form method="POST" action="index.php?controller=cliente&action=salvar">

            <div class="input-field">
                <input type="text" name="nome" required>
                <label>Nome</label>
            </div>

            <div class="input-field">
                <input type="email" name="email" required>
                <label>E-mail</label>
            </div>

            <div class="input-field">
                <input type="text" name="telefone" required>
                <label>Telefone</label>
            </div>

            <div class="input-field">
                <input type="text" name="endereco" required>
                <label>Endereço</label>
            </div>

            <button type="submit" class="btn">Salvar Cliente</button>
        </form>
    </div>
</div>

<table class="striped responsive-table">
    <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Ação</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= htmlspecialchars($cliente['nome']) ?></td>
                <td><?= htmlspecialchars($cliente['email']) ?></td>
                <td><?= htmlspecialchars($cliente['telefone']) ?></td>
                <td><?= htmlspecialchars($cliente['endereco']) ?></td>
                <td>
                    <a class="btn red" href="index.php?controller=cliente&action=excluir&id=<?= $cliente['id'] ?>">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require "../app/views/layout/footer.php"; ?>
