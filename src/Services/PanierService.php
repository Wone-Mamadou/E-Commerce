<?php

namespace App\Services;

use App\Repository\ProduitRepository;
// use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PanierService
{
    private $session;
    private $repoProduit;
     
    public function __construct(SessionInterface $session, ProduitRepository $repoProduit)
    {
        $this->session = $session;
        $this->repoProduit = $repoProduit;
    }

    public function addToPanier($id)
    {
        $panier = $this->getPanier();

        if (isset($panier[$id])) {
            // le produit est déja dans  le panier
            $apnier[$id]++;
        } else {
            // le produit n'est pas enncore dans le panier
            $panier[$id] = 1;
        }

        // mettre à jour la session
        $this->updatePanier($panier);
    }

    public function deleteFromPanier($id)
    {
        $panier = $this->getPanier();

        if (isset($panier[$id])) {
            // produit déja dans le panier
            if ($panier[$id] > 1) {
                // produit existe plus d'une fois
                $panier[id]--;
            } else {
                unset($panier[$id]);
            }
        }
        // mettre à jour la session
        $this->updatePanier($panier);
    }

    public function deleteAllToPanier($id)
    {
        $panier = $this->getPanier();

        if (isset($panier[$id])) {

            // produit déja dans le panier
            unset($panier[$id]);
        }
        // mettre à jour la session
        $this->updatePanier($panier);
    }

    public function deletePanier()
    {
        $this->updatePanier([]);
    }

    public function updatePanier($panier)
    {
        $this->session->set('panier', $panier);
    }

    public function getPanier()
    {
        return $this->session->get('panier', []);
    }

    public function getFullPanier()
    {
        $panier = $this->getPanier();

        $fullPanier = [];
        foreach ($panier as $id => $quantity) {
            if ($produit) {
                // produit récupéré avec succès
                $fullPanier[]=
                [
                    "quantity" => $quantity,
                    "produit" => $produit,
                ];
            } else {
                // id incorrecte
                $this->deleteFromPanier($id);
            }
        }
    }
}
