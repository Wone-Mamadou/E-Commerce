<?php

namespace App\Controller;

use App\Services\PanierService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier')]
    public function index(PanierService $panierService): Response
    {
        $panierService->addToPanier(3);

        dd($panierService->getPanier());
        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
        ]);
    }
}
