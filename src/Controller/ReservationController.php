<?php 
namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    private $security;
    private $reservationRepository;

    public function __construct(Security $security, ReservationRepository $reservationRepository)
    {
        $this->security = $security;
        $this->reservationRepository = $reservationRepository;
    }

    #[Route('/reservations', name: 'app_reservations', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
        if (!$this->security->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->security->getUser();

        if ($request->request->get('email') === null) {
            // La valeur de la propriété mail est nulle, vous devez gérer cette erreur
            // Par exemple, vous pouvez afficher un message d'erreur à l'utilisateur
            $this->addFlash('error', 'Le champ email est obligatoire');
            return $this->redirectToRoute('app_reservations');
        }
        if ($request->request->get('nom') === null) {
            // La valeur de la propriété nom est nulle, vous devez gérer cette erreur
            // Par exemple, vous pouvez afficher un message d'erreur à l'utilisateur
            $this->addFlash('error', 'Le champ nom est obligatoire');
            return $this->redirectToRoute('app_reservations');
        }
        if ($request->request->get('date') === null) {
            // La valeur de la propriété date est nulle, vous devez gérer cette erreur
            // Par exemple, vous pouvez afficher un message d'erreur à l'utilisateur
            $this->addFlash('error', 'Le champ date est obligatoire');
            return $this->redirectToRoute('app_reservations');
        }
        if ($request->request->get('heur') === null) {
            // La valeur de la propriété heur est nulle, vous devez gérer cette erreur
            // Par exemple, vous pouvez afficher un message d'erreur à l'utilisateur
            $this->addFlash('error', 'Le champ heure est obligatoire');
            return $this->redirectToRoute('app_reservations');
        }
        if ($request->request->get('nombrePersonnes') === null) {
            // La valeur de la propriété nombrePersonnes est nulle, vous devez gérer cette erreur
            // Par exemple, vous pouvez afficher un message d'erreur à l'utilisateur
            $this->addFlash('error', 'Le champ nombre de personnes est obligatoire');
            return $this->redirectToRoute('app_reservations');
        }

        if ($request->isMethod('POST')) {
            $reservation = new Reservation();
            $reservation->setNom($request->request->get('nom'));
            $reservation->setPrenom($request->request->get('prenom'));
            $reservation->setMail($request->request->get('email'));
            $reservation->setDate(new \DateTime($request->request->get('date')));
            $reservation->setHeur(new \DateTime($request->request->get('heur')));
            $reservation->setNombrePersonnes($request->request->get('nombrePersonnes'));

            $this->reservationRepository->add($reservation);

            return $this->redirectToRoute('app_reservations'); // Retourner une instance de Response
        }

        return $this->render('reservation/réservation.html.twig', [
            'controller_name' => 'ReservationController'
        ]);
    }
}