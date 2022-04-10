<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cg')]
class CGController extends AbstractController
{
    #[Route('/conditions-generales-utilisation', name: 'cg_conditions')]
    public function index(): Response
    {
        return $this->render('cg/index.html.twig', [
            'controller_name' => 'CGController',
        ]);
    }
}
