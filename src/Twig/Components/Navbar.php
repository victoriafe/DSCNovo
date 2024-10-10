<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Navbar
{
    public string $title;

    public array $routes = [
        'tables' => [
            'name' => 'app_table_index',
            'title' => 'Mesas',
            'access' => 'ROLE_ADMIN',
        ]
    ];

}
