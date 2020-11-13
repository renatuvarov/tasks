<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Task;
use App\Models\User;
use App\SortQueryHandler;
use Src\AbstractController;
use Src\Paginator;

class MainController extends AbstractController
{
    public function __invoke()
    {
        $queryParams = $this->request->query();

        $tasks = Task::paginate(
            $queryParams['order_by'],
            $queryParams['sort'],
            $queryParams['page'] ? (int) $queryParams['page'] : null
        );

        $taskCount = Task::count();

        $success = $this->session()->getMessages('success');

        $paginator = new Paginator($taskCount, Task::PER_PAGE, $this->request->uri(), $queryParams);

        $sortFields = Task::getSortFields();
        $sortQueryHandler = new SortQueryHandler(array_keys($sortFields), $queryParams);

        $this->renderView('main', [
            'tasks' => $tasks,
            'taskCount' => $taskCount,
            'user' =>  $this->isUserAuthorized() ? new User() : null,
            'success' => $success,
            'paginator' => $paginator,
            'sortQueryHandler' => $sortQueryHandler,
            'sortFields' => $sortFields,
        ]);
    }
}