<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConceptController extends AbstractController
{
    #[Route('/concept', name: 'app_concept')]
    public function index(): Response
    {
        return $this->render('concept/concept.html.twig', [
            'controller_name' => 'ConceptController',
        ]);
    }
}
