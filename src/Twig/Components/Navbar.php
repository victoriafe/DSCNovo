<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Navbar
{
    public string $title;

    public array $routes = [
        'table_orders' => [
            'name' => 'app_table_order_index',
            'title' => 'Comandas',
            'access' => 'ROLE_WAITER',
        ],
        'tables' => [
            'name' => 'app_table_index',
            'title' => 'Mesas',
            'access' => 'ROLE_ADMIN',
        ],
        'products' => [
            'name' => 'app_product_index',
            'title' => 'Produtos',
            'access' => 'ROLE_ADMIN',
        ],
        'stock' => [
            'name' => 'app_stock_index',
            'title' => 'Estoque',
            'access' => 'ROLE_ADMIN',
        ],
    ];

}
