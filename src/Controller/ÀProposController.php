<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ÀProposController extends AbstractController
{
    #[Route('//propos', name: 'app__propos')]
    public function index(): Response
    {
        return $this->render('Àpropos/ÀPropos.html.twig', [
            'controller_name' => 'ÀProposController',
        ]);
    }
}
