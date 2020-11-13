<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Task;
use Src\AbstractController;
use Src\Validator;

class CreateTaskController extends AbstractController
{
    public function __invoke()
    {
        if ($this->request->isPost()) {
            $taskData = $this->request->body();

            $validator = new Validator($taskData, [
                'name' => ['required'],
                'email' => ['required', 'email'],
                'text' => ['required'],
            ]);

            $validator->validate();

            if ($validator->isValid()) {
                Task::create($taskData['name'], $taskData['email'], $taskData['text']);
                $this->session()->setMessages('success', ['задача создана.']);

                $this->redirect('/');
            }

            $errors = $validator->getErrors();
        }

        $this->renderView('create', [
            'errors' => $errors ?? [],
        ]);
    }
}