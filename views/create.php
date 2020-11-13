<?php require_once 'messages.php'; ?>

<form action="/create" method="post" class="d-block mt-5 w-25 ml-auto mr-auto">
    <h2 class="h3 text-center mt-3">Создать задачу</h2>
    <div class="form-group">
        <label for="name">Имя</label>
        <input type="text"
               class="form-control"
               id="name"
               name="name">
    </div>
    <div class="form-group">
        <label for="email">E-mail</label>
        <input type="text" class="form-control" id="email" name="email">
    </div>
    <div class="form-group">
        <label for="text">Текст</label>
        <input type="text" class="form-control" id="text" name="text">
    </div>
    <button type="submit" class="btn btn-primary">Создать</button>
</form>