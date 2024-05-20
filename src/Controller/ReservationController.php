<?php

namespace App\Controller;

use App\Repository\ReservationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservations', name: 'app_reservation', methods: ['GET'])]
    public function index(ReservationRepository $repo): Response
    {

        $reservations= $repo ->findAll();

        return $this->render('reservation/réservation.html.twig', [
            // 'controller_name' => 'ReservationController',
            'LesReservations' => $reservations
        ]);
    }

    // #[Route('/reservation', name: 'app_reservation', methods: ['GET'])]
    // public function reservation($id, ReservationRepository $repo): Response
    // {

    //     $reservation= $repo ->find($id);

    //     return $this->render('reservation/réservation.html.twig', [
    //         // 'controller_name' => 'ReservationController',
    //         'LaReservation' => $reservation
    //     ]);
    // }
}
