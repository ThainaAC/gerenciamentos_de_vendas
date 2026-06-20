<?php require "../app/views/layout/header.php"; ?>

<?php
    $cliente = $cliente ?? null;
?>

<h4>Editar Cliente</h4>

<?php if (!$cliente): ?>

    <div class="card-panel red lighten-4 red-text text-darken-4">
        Cliente não encontrado.
    </div>

    <a href="index.php?controller=cliente&action=index" class="btn">
        Voltar
    </a>

<?php else: ?>

<div class="card">
    <div class="card-content">

        <form method="POST" action="index.php?controller=cliente&action=atualizar">

            <input type="hidden" name="id" value="<?= $cliente['id'] ?>">

            <div class="input-field">
                <input type="text" name="nome" value="<?= htmlspecialchars($cliente['nome']) ?>" required>
                <label class="active">Nome</label>
            </div>

            <div class="input-field">
                <input type="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>
                <label class="active">E-mail</label>
            </div>

            <div class="input-field">
                <input type="text" name="telefone" value="<?= htmlspecialchars($cliente['telefone']) ?>" required>
                <label class="active">Telefone</label>
            </div>

            <div class="input-field">
                <input type="text" name="endereco" value="<?= htmlspecialchars($cliente['endereco']) ?>" required>
                <label class="active">Endereço</label>
            </div>

            <button type="submit" class="btn">
                Atualizar Cliente
            </button>

            <a href="index.php?controller=cliente&action=index" class="btn grey">
                Cancelar
            </a>

        </form>

    </div>
</div>

<?php endif; ?>

<?php require "../app/views/layout/footer.php"; ?>