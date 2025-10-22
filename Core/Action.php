<?php
namespace Core;

class Action
{
    protected function render(string $view, array $data = [])
    {
        extract($data);
        require_once __DIR__ . '/../App/Views/layout/header.php';
        require_once __DIR__ . '/../App/Views/' . $view . '.php';
        require_once __DIR__ . '/../App/Views/layout/footer.php';
    }
}
