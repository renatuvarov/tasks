<?php
/**
 * @var \Src\View $this
 */
?>

<h1 class="h1 text-center mt-3">Вход</h1>

<?php require_once 'messages.php'; ?>

<form action="/login" method="post" class="d-block mt-2 w-25 ml-auto mr-auto">
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text"
               class="form-control"
               id="login"
               name="login">
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
</form>