<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class Navbar
{
    public string $title;

    public array $routes = [
        'menu' => [
            'name' => 'app_menu_index',
            'title' => 'Cardápio',
            'access' => 'ROLE_USER'
        ],
        'table_orders' => [
            'name' => 'app_table_order_index',
            'title' => 'Comandas',
            'access' => 'ROLE_WAITER',
        ],
        'orders' => [
            'name' => 'app_order_index',
            'title' => 'Pedidos',
            'access' => 'ROLE_WAITER',
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
        'tables' => [
            'name' => 'app_table_index',
            'title' => 'Mesas',
            'access' => 'ROLE_ADMIN',
        ],
        'users' => [
            'name' => 'app_user_index',
            'title' => 'Usuários',
            'access' => 'ROLE_ADMIN',
        ],
        'reports' => [
            'name' => 'app_report_index',
            'title' => 'Relatórios',
            'access' => 'ROLE_ADMIN',
        ]
    ];

}
