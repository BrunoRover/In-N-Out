<?php
$errors = $user->validate();


?>
<main class="content">
    <div class="content-title mb-4">
            <i class="icon icofont-user mr-2"></i>
        <div>
            <h1>Cadastro de Usuários</h1>
            <h2>Crie e atualize os usuários</h2>
            
        </div>
    </div>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">Nome</label>
                <input type="text" name="name" id="name" placeholder="Informe seu nome" class="form-control <?= $errors['name'] ? "is-invalid" : '' ?>" value="<?= $name ?>">
                <div class="invalid-feedback">
                    <?= $errors['name'] ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" placeholder="Informe o email" class="form-control <?= $errors['email'] ? "is-invalid" : '' ?>" value="<?= $email ?>">
                <div class="invalid-feedback">
                    <?= $errors['email'] ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Senha</label>
                <input type="password" name="password" id="password" placeholder="Informe sua senha" class="form-control <?= $errors['password'] ? "is-invalid" : '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['password'] ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="confirm_password">Confirmar senha</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirme sua senha" class="form-control <?= $errors['confirm_password'] ? "is-invalid" : '' ?>">
                <div class="invalid-feedback">
                    <?= $errors['confirm_password'] ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="start_date">Data de Admissão</label>
                <input type="date" name="start_date" id="start_date" class="form-control <?= $errors['start_date'] ? "is-invalid" : '' ?>" value="<?= $start_date ?>">
                <div class="invalid-feedback">
                    <?= $errors['start_date'] ?>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="end_date">Data de Desligamento</label>
                <input type="date" name="end_date" id="end_date" class="form-control <?= $errors['end_date'] ? "is-invalid" : '' ?>" value="<?= $end_date ?>">
                <div class="invalid-feedback">
                    <?= $errors['end_date'] ?>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-1">
                <label for="is_admin">Administrador?</label>
                <input type="checkbox" name="is_admin" id="is_admin" class="form-control <?= $errors['is_admin'] ? "is-invalid" : '' ?>" <?= $is_admin ? 'checked' : '' ?>>
                <div class="invalid-feedback">
                    <?= $errors['is_admin'] ?>
                </div>
            </div>
        </div>
        <button class="btn btn-primary btn-lg">Salvar</button>
        <a href="users.php" class="btn btn-secondary btn-lg">Cancelar</a>
    </form>
</main>