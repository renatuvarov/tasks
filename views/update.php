<?php require_once 'messages.php'; ?>

<form action="/update/<?php echo htmlspecialchars($task->id) ?>" method="post" class="d-block mt-5 w-50 ml-auto mr-auto">
    <h5 class="card-title">Редактировать</h5>
    <div class="form-group">
        <label for="text">Текст</label>
        <input type="text" class="form-control" id="text" name="text">
    </div>

    <?php if ($task->completed === 0): ?>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="completed" name="completed" value="1">
            <label class="form-check-label" for="completed">Выполнена</label>
        </div>
    <?php endif; ?>

    <button type="submit" class="btn btn-primary">Обновить</button>
</form>