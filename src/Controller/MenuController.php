<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu_index')]
    public function index(ProductRepository $productRepository, Request $request): Response
    {
        $search = $request->query->get('search');

        if ($search) {
            $products = $productRepository->findBySearch($search);
        } else {
            $products = $productRepository->findAllWithStock();
        }

        $categories = [];

        foreach ($products as $product) {
            $category = $product->getCategory();

            if (!isset($categories[$category])) {
                $categories[$category] = [];
            }

            $categories[$category][] = $product;
        }

        ksort($categories);

        return $this->render('menu/index.html.twig', [
            'categories' => $categories,
            'controller_name' => 'MenuController',
        ]);
    }

}
