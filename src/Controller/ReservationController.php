<?php 
namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// Cette classe hérite de la classe AbstractController
class ReservationController extends AbstractController
{
     // Attribut privé qui stocke une instance de FormFactoryInterface
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        // On stocke l'instance de FormFactoryInterface dans l'attribut privé $formFactory
        $this->formFactory = $formFactory;
    }

     // Méthode qui répond à la requête GET ou POST sur l'URL /reservations
    #[Route('/reservations', name: 'app_reservations', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        // On crée une nouvelle instance de la classe Reservation
        $reservation = new Reservation();

        // On crée un formulaire à partir de la classe FormType et de l'instance $reservation
        $form = $this->formFactory->createBuilder(FormType::class, $reservation)
            ->add('nom', TextType::class) // On traite la requête avec le formulaire
            ->add('prenom', TextType::class) // On traite la requête avec le formulaire
            ->add('mail', EmailType::class) // On traite la requête avec le formulaire
            ->add('date', DateType::class) // On traite la requête avec le formulaire
            ->add('heure', TimeType::class)// On traite la requête avec le formulaire
            ->add('nombrePersonnes', IntegerType::class) // On traite la requête avec le formulaire
            ->getForm();

        // On traite la requête avec le formulaire
        $form->handleRequest($request);

         // Si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            $reservation = $form->getData();
            //...
        }

         // On rend la vue reservation/réservation.html.twig avec le formulaire créé
        return $this->render('reservation/réservation.html.twig', [
            'form' => $form->createView(),
        ]);
    

        if ($request->isMethod('POST')) {
            $reservation = new Reservation();
            $reservation->setNom($request->request->get('nom'));
            $reservation->setPrenom($request->request->get('prenom'));
            $reservation->setMail($request->request->get('email'));
            $reservation->setDate(new \DateTime($request->request->get('date')));
            $reservation->setHeure(new \DateTime($request->request->get('heur')));
            $reservation->setNombrePersonnes($request->request->get('nombrePersonnes'));


            return $this->redirectToRoute('app_reservations'); // Retourner une instance de Response
        }

        return $this->render('reservation/réservation.html.twig', [
            'controller_name' => 'ReservationController'
        ]);
    }
}