<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Task;
use Exception;
use Src\AbstractController;
use Src\Validator;

class UpdateTaskController extends AbstractController
{
    public function __invoke()
    {
        if (! $this->isUserAuthorized()) {
            $this->redirect('/login');
        }

        $task = Task::findById((int)$this->request->query()['id']);

        if (is_null($task)) {
            throw new Exception('задача не найдена.', 404);
        }

        if ($this->request->isPost()) {
            $taskData = $this->request->body();

            $validator = new Validator($taskData, []);

            if ($validator->isValid()) {
                $task->update($taskData['text'], (int)$taskData['completed']);
                $this->session()->setMessages('success', ['задача обновлена.']);

                $this->redirect('/');
            }

            $errors = $validator->getErrors();
        }

        $this->renderView('update', [
            'task' => $task,
            'errors' => $errors ?? [],
        ]);
    }
}