<?php

namespace App\Controller;

use App\Entity\Table;
use App\Repository\TableOrderRepository;
use App\Repository\TableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{

    public function __construct(private readonly TableRepository $repository)
    {
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        if ($this->isGranted('ROLE_WAITER')) {
            $tables = $this->repository->findAll();

            return $this->render('index/tables.html.twig', [
                'tables' => $tables,
            ]);
        }

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    #[Route('/order_from_table/{id}', name: 'app_index_order_from_table', methods: ['GET'])]
    public function redirectToTableOrder(Table $table, TableOrderRepository $repository): Response
    {
        $tableOrder = $repository->findOngoingByTable($table);

        if ($tableOrder) {
            return $this->redirectToRoute('app_table_order_show', ['id' => $tableOrder->getId()]);
        }

        return $this->redirectToRoute('app_table_order_new', ['id' => $table->getId()]);
    }
}
