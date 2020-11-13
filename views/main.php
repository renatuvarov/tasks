<div class="text-center mt-5">
    <div class="mt-5 text-center">
        <?php if (!is_null($user)): ?>
            <a href="/logout" class="btn btn-danger">Выход</a>
        <?php else: ?>
            <a href="/login" class="btn btn-info">Вход</a>
        <?php endif; ?>
    </div>
    <hr>
    <h2 class="h3 text-center mt-5 mb-3">Задачи</h2>

    <a href="/create" class="btn btn-success">Создать задачу</a>

    <div class="mt-5 w-50 mr-auto ml-auto">
        <?php if (count($tasks) > 0): ?>
            <ul class="d-flex justify-content-around mt-3">
                <?php foreach ($sortFields as $fieldName => $fieldDescription): ?>
                    <li class="list-unstyled">
                        <a href="/?<?php echo htmlspecialchars($sortQueryHandler->getQueryParams()[$fieldName]) ?>"
                           class="btn btn-warning">
                            <?php echo htmlspecialchars($fieldDescription) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php foreach ($tasks as $task): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($task->name) ?></h5>
                        <p class="card-text">E-mail: <?php echo htmlspecialchars($task->email) ?></p>
                        <p class="card-text"><?php echo htmlspecialchars($task->text) ?></p>

                        <?php if ($task->completed === 1): ?>
                            <p class="card-text text-bold text-success">Выполнена</p>
                        <?php endif; ?>

                        <?php if ($task->edited === 1): ?>
                            <p class="card-text text-bold text-info font-weight-bold">Отредактировано
                                администратором</p>
                        <?php endif; ?>

                        <?php if (!is_null($user)): ?>
                            <a href="/update/<?php echo htmlspecialchars($task->id) ?>" class="btn btn-info">Редактировать задачу</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <?php if ($taskCount > \App\Models\Task::PER_PAGE): ?>
                <ul class="pagination d-flex justify-content-center">
                    <?php foreach ($paginator->links() as $index => $link): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo htmlspecialchars($link) ?>">
                                <?php echo $index + 1 ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php else: ?>
            <p>Задач пока нет.</p>
        <?php endif; ?>
    </div>
</div>
