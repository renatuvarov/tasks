<?php

declare(strict_types=1);

namespace Src;

abstract class AbstractController
{
    protected View $view;

    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->view = new View();
    }

    protected function isUserAuthorized(): bool
    {
        return $this->session()->has('authorized');
    }

    protected function redirect(string $path = '/'): void
    {
        header('Location: ' . $path);
    }

    public function session(): Session
    {
        return $this->request->session();
    }

    public function renderView(string $template, array $data = []): void
    {
        $this->view->render($template, $data);
    }
}