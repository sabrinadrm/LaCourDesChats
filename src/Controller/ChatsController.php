<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ChatsController extends AbstractController
{
    #[Route('/chats', name: 'app_chats')]
    public function index(): Response
    {
        return $this->render('chats/Chats.html.twig', [
            'controller_name' => 'ChatsController',
        ]);
    }
}
