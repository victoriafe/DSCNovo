<?php

namespace App\Controller;

use App\Entity\TableOrder;
use App\Form\TableOrderType;
use App\Repository\TableOrderRepository;
use App\Service\TemplateHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/table_order')]
final class TableOrderController extends AbstractController
{
    public function __construct(private readonly TemplateHelper $templateHelper)
    {
    }

    #[Route(name: 'app_table_order_index', methods: ['GET'])]
    public function index(TableOrderRepository $tableOrderRepository): Response
    {
        return $this->render('table_order/index.html.twig', [
            'table_orders' => $tableOrderRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_table_order_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tableOrder = new TableOrder();
        $form = $this->createForm(TableOrderType::class, $tableOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tableOrder);

            $tableOrder->setOrderDate(new \DateTime('now'));
            $tableOrder->setTotalValue(0);

            $entityManager->flush();

            return $this->redirectToRoute('app_table_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->templateHelper->renderCrud('comanda', 'table_order', $tableOrder, $form);
    }

    #[Route('/{id}', name: 'app_table_order_show', methods: ['GET'])]
    public function show(TableOrder $tableOrder): Response
    {
        return $this->render('table_order/show.html.twig', [
            'table_order' => $tableOrder,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_table_order_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TableOrder $tableOrder, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TableOrderType::class, $tableOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_table_order_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->templateHelper->renderCrud('comanda', 'table_order', $tableOrder, $form, true);
    }

    #[Route('/{id}', name: 'app_table_order_delete', methods: ['POST'])]
    public function delete(Request $request, TableOrder $tableOrder, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tableOrder->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tableOrder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_table_order_index', [], Response::HTTP_SEE_OTHER);
    }
}