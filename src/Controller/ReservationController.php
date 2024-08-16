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
use Doctrine\ORM\EntityManagerInterface;

class ReservationController extends AbstractController
{
    private $formFactory;
    private $entityManager;

    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $entityManager)
    {
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
    }

    #[Route('/reservations', name: 'app_reservations', methods: ['GET', 'POST'])]
    public function index(Request $request): Response
    {
        $reservation = new Reservation();
    
        $form = $this->formFactory->createBuilder(FormType::class, $reservation)
            ->add('nom', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom',
            ])
            ->add('mail', EmailType::class, [
                'label' => 'Adresse e-mail',
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
            ])
            ->add('heure', TimeType::class, [
                'label' => 'Heure',
            ])
            ->add('nombrePersonnes', IntegerType::class, [
                'label' => 'Nombre de personnes',
            ])
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $this->entityManager->persist($reservation);
                $this->entityManager->flush();
                $this->addFlash('success', 'Réservation ajoutée avec succès!');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Erreur lors de l\'ajout de la réservation : ' . $e->getMessage());
            }
        }
    
        return $this->render('reservation/réservation.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}