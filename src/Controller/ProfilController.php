<?php

namespace App\Controller;


use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(Security $security): Response
    {
        $user = $security->getUser();

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'user'  =>   $user,
        ]);
    }
}
