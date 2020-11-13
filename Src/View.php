<?php

declare(strict_types=1);

namespace Src;

class View
{
    private const LAYOUT = __DIR__ . '/../views/layouts/default.php';

    private const TEMPLATE_DIR = __DIR__ . '/../views/';

    public function render(string $template, array $data = []): void
    {
        extract($data);

        ob_start();
        include_once self::TEMPLATE_DIR . $template . '.php';
        $fragment = ob_get_clean();

        include_once self::LAYOUT;
    }
}