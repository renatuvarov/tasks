<?php

declare(strict_types=1);

namespace App\Controllers;

use Src\AbstractController;

class LogoutController extends AbstractController
{
    public function __invoke()
    {
        if ($this->isUserAuthorized()) {
            $this->session()->unset('authorized');
        }

        $this->redirect('/');
    }
}