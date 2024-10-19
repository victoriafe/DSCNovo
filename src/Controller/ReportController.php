<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\StockRepository;
use App\Repository\TableOrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReportController extends AbstractController
{
    private OrderRepository $orderRepository;
    private TableOrderRepository $tableOrderRepository;
    private ProductRepository $productRepository;
    private StockRepository $stockRepository;

    public function __construct(
        OrderRepository      $orderRepository,
        TableOrderRepository $tableOrderRepository,
        ProductRepository    $productRepository,
        StockRepository      $stockRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->tableOrderRepository = $tableOrderRepository;
        $this->productRepository = $productRepository;
        $this->stockRepository = $stockRepository;
    }

    #[Route('/report', name: 'app_report_index')]
    public function index(): Response
    {
        // Total de vendas e receita
        $salesData = $this->orderRepository->createQueryBuilder('o')
            ->select('SUM(o.subtotal) AS totalRevenue, COUNT(o.id) AS totalSales')
            ->getQuery()
            ->getSingleResult();

        // Produtos mais vendidos
        $topProducts = $this->orderRepository->createQueryBuilder('o')
            ->select('p.name, SUM(o.quantity) AS totalQuantity')
            ->join('o.product', 'p')
            ->groupBy('p.id')
            ->orderBy('totalQuantity', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();

        // Categorias mais vendidas
        $topCategories = $this->orderRepository->createQueryBuilder('o')
            ->select('p.category, SUM(o.quantity) AS totalQuantity')
            ->join('o.product', 'p')
            ->groupBy('p.category')
            ->orderBy('totalQuantity', 'DESC')
            ->getQuery()
            ->getResult();

        // Níveis de estoque
        $stockLevels = $this->stockRepository->createQueryBuilder('s')
            ->select('p.name AS productName, s.quantity, s.purchasePrice, s.salePrice')
            ->join('s.product', 'p')
            ->getQuery()
            ->getResult();

        // Tabelas ocupadas e seus respectivos pedidos
        $occupiedTablesData = $this->tableOrderRepository->createQueryBuilder('to')
            ->select('t.id AS tableId, COUNT(o.id) AS totalOrders')
            ->join('to.occupiedTable', 't')
            ->leftJoin('to.orders', 'o')
            ->groupBy('t.id')
            ->getQuery()
            ->getResult();

        // Produtos em estoque
        $productsInStock = $this->productRepository->createQueryBuilder('p')
            ->select('p.name, s.quantity AS stockQuantity')
            ->join('p.stock', 's')
            ->getQuery()
            ->getResult();

        // Total de pedidos
        $totalOrders = $this->tableOrderRepository->count();

        dump($totalOrders);

        return $this->render('report/index.html.twig', [
            'totalOrders' => $totalOrders,
            'totalRevenue' => $salesData['totalRevenue'] ?? 0,
            'totalSales' => $salesData['totalSales'] ?? 0,
            'topProducts' => $topProducts,
            'topCategories' => $topCategories,
            'stockLevels' => $stockLevels,
            'occupiedTablesData' => $occupiedTablesData,
            'productsInStock' => $productsInStock,
        ]);
    }
}
