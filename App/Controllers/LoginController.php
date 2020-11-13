<?php

declare(strict_types=1);

namespace App\Controllers;

use Src\AbstractController;
use Src\Validator;

class LoginController extends AbstractController
{
    public function __invoke()
    {
        if ($this->isUserAuthorized()) {
            $this->redirect('/');
        }

        if ($this->request->isPost()) {
            $loginData = $this->request->body();

            $validator = new Validator($loginData, [
                'login' => ['required', 'login'],
                'password' => ['required', 'password'],
            ]);

            $validator->validate();

            if ($validator->isValid()) {
                $this->session()->set('authorized', true);
                $this->redirect('/');
            }

            $errors = $validator->getErrors();
        }

        $this->renderView('login', [
            'errors' => $errors ?: [],
        ]);
    }
}