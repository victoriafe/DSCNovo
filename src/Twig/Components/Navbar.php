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
            'access' => 'ROLE_USER',
            'icon_name' => 'bi bi-list-ul', // Ícone de lista
        ],
        'table_orders' => [
            'name' => 'app_table_order_index',
            'title' => 'Comandas',
            'access' => 'ROLE_WAITER',
            'icon_name' => 'bi bi-file-earmark-text', // Ícone de arquivo
        ],
        'orders' => [
            'name' => 'app_order_index',
            'title' => 'Pedidos',
            'access' => 'ROLE_CHEF',
            'icon_name' => 'bi bi-receipt', // Ícone de recibo
        ],
        'products' => [
            'name' => 'app_product_index',
            'title' => 'Produtos',
            'access' => 'ROLE_ADMIN',
            'icon_name' => 'bi bi-box', // Ícone de caixa
        ],
        'stock' => [
            'name' => 'app_stock_index',
            'title' => 'Estoque',
            'access' => 'ROLE_ADMIN',
            'icon_name' => 'bi bi-stack', // Ícone de pilha
        ],
        'tables' => [
            'name' => 'app_table_index',
            'title' => 'Mesas',
            'access' => 'ROLE_ADMIN',
            'icon_name' => 'bi bi-table', // Ícone de mesa
        ],
        'users' => [
            'name' => 'app_user_index',
            'title' => 'Usuários',
            'access' => 'ROLE_ADMIN',
            'icon_name' => 'bi bi-person', // Ícone de usuário
        ],
        'reports' => [
            'name' => 'app_report_index',
            'title' => 'Relatórios',
            'access' => 'ROLE_ADMIN',
            'icon_name' => 'bi bi-file-earmark-bar-graph', // Ícone de gráfico
        ]

    ];

}
