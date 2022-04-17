<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(ProduitRepository $repoProduit): Response
    {
        $produit = $repoProduit->findAll();

        $meilleurVente = $repoProduit->findByMeileureVente(1);
        
        $offreSpeciale = $repoProduit->findByOffreSpeciale(1);
        
        $nouvelleArrivage = $repoProduit->findByNouvelleArrivage(1);
        
        $isFeatured = $repoProduit->findByIsFeaturead(1);
        
        // dd([$meilleurVente, $offreSpeciale, $nouvelleArrivage, $isFeatured]);

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'produit' => $produit,
            'meilleurVente' => $meilleurVente,
            'offreSpeciale' => $offreSpeciale,
            'nouvelleArrivage' => $nouvelleArrivage,
            'isFeatured' => $isFeatured
        ]);
    }

    #[Route('/produit/{slug}', name: 'produit_details')]
    public function show(?Produit $produit): Response
    {
        if (!$produit) {
            return $this->redirectToRoute("accueil");
        }

        return $this->render("accueil/single_produit.html.twig", [
        'produit' => $produit
      ]);
    }
}
